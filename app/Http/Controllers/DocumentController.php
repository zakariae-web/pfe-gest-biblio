<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Réservation;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('document.index',
        ['document' => Document::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Créer un nouveau document
        $document = new Document();

        $document->titre = $request->input('titre');
        $document->type_document = $request->input('type_document');
        $document->nom_editeur = $request->input('nom_editeur');
        $document->auteur_principal = $request->input('auteur_principal');
        $document->periodicite_parution = $request->input('periodicite_parution');
        $document->cote = $request->input('cote');
    
        // Enregistrer le nouveau document dans la base de données
        $document->save();
    
        // Appeler la fonction pour réserver le document
        $this->reserverDocument($document->id);
    
        // Rediriger l'utilisateur
        return redirect()->route('document.index');
    }
    
    public function reserverDocument($document_id)
    {
        $document = Document::find($document_id);
    
        if ($document->nombre_de_copies > 0) {
            // Créer la réservation
            $reservation = new Réservation();
            $reservation->user_id = auth()->user()->id;
            $reservation->document_id = $document_id;
            $reservation->start_date = now();
            $reservation->end_date = now()->addDays(7);
            $reservation->is_active = 1;
            $reservation->save();
    
            // Décrémenter le nombre de copies disponibles
            $document->nombre_de_copies--;
            $document->save();
    
            // Afficher un message de succès
            return redirect()->back()->with('success', 'La réservation a été effectuée avec succès.');
        } else {
            // Afficher un message d'erreur
            return redirect()->back()->with('error', 'Le document n\'est pas disponible pour la réservation.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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
        $document = Document::findorfail($id);
        $document->delete();
        return redirect()->route('document.index');
    }
}
