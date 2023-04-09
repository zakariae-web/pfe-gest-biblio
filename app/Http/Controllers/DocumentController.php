<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Réservation;
use App\Models\Adhérant;
use Illuminate\Support\Facades\Auth;


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
        // $this->reserverDocument($document->id);
    
        // Rediriger l'utilisateur
        return redirect()->route('document.index');
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
    public function emprunterLivre(Request $request, $id)
{
    $document = Document::find($id);

    if (!$document) {
        return back()->withError('Livre non trouvé.');
    }

    $adherent = Auth::user()->adherent;


    $document->emprunter();
    $adherent->nombre_livres_empruntes++;
    $adherent->save();

    return redirect()->route('document.index', $document->id)->withSuccess('Livre emprunté avec succès.');
}

}
