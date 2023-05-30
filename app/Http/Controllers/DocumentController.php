<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Réservation;
use App\Models\Adhérant;
use App\Models\Emprunt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouForBorrowing;


use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $documentsQuery = Document::query();


        if ($request->has('cote')) {
            $cote = $request->cote;
            if ($cote !== 'all') {
                $documentsQuery->where('cote', $cote);
            }
        }
    
        // search for document by name 
        if ($request->has('titre')) {
            $titre = $request->titre;
            $documentsQuery->where('titre', 'LIKE', '%' . $titre . '%');
        }
    
        $documents = $documentsQuery->Paginate(8);



        return view('document.index', [
            'documents' => $documents
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage-documents');
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('manage-documents');

        $file_extension = $request -> image -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images';
        $request -> image -> move($path,$file_name);

     $document = new Document();

        $document->titre = $request->input('titre');
        $document['image']= $file_name;
        $document->type_document = $request->input('type_document');
        $document->nom_editeur = $request->input('nom_editeur');
        $document->auteur_principal = $request->input('auteur_principal');
        $document->periodicite_parution = $request->input('periodicite_parution');
        $document->cote = $request->input('cote');
    
        $document->save();   
    
        return redirect()->route('document.index');
    }
    public function validerEmprunt($document_id)
    {
        // Vérifier que le document existe
        $document = Document::findOrFail($document_id);
    
        // Vérifier que la réservation correspond bien au document
        $reservation = Réservation::where('document_id', $document->id)
            ->where('is_active', true)
            ->first();
    
        if ($reservation->user->emprunts()->count() >= 5) {
            return back()->withErrors(['error' => 'Ce utilisateur a atteint le nombre maximum d\'emprunts.']);
        }

        if ($document->nombre_de_copies <= 0) {
            return back()->withErrors(['error' => 'Le document est déjà emprunté par tous les utilisateurs.']);
        }
        
        $document->nombre_de_copies--;
        $document->save();
    
        // Créer un nouvel enregistrement dans la table `emprunts`
        $emprunt = new Emprunt;
        $emprunt->user_id = $reservation->user_id;
        $emprunt->document_id = $document->id;
        $emprunt->reservation_id = $reservation->id;
        $emprunt->date_emprunt = Carbon::now();
        $emprunt->date_retour = Carbon::now()->addDays(7);
        $emprunt->save();

        $userEmail = $emprunt->user->email;
        $userName = $emprunt->user->name;
        $bookName = $document->titre;

        Mail::to($userEmail)->send(new ThankYouForBorrowing($userName, $bookName));

    
        $reservation->delete();
    
        return back()->with('success', 'Emprunt validé avec succès.');
    }
    
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $document = Document::findorfail($id);
        return view('document.show',compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('manage-documents');
        $document = Document::findorfail($id);
        return view('document.edit', [
            'document' => $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('manage-documents');
        $document = Document::findorfail($id);

        $document->titre =$request->input('titre');
        $document->type_document =$request->input('type_document');
        $document->nom_editeur =$request->input('nom_editeur');
        $document->auteur_principal =$request->input('auteur_principal');
        $document->periodicite_parution =$request->input('periodicite_parution');
        $document->cote =$request->input('cote');

        $document->save();
        return redirect()->route('document.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('manage-documents');
        $document = Document::findorfail($id);
        $document->delete();
        return redirect()->route('document.index');
    }

}
