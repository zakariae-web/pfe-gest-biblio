<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprunt;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Réservation;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $emprunts = Emprunt::all();
        } else {
            $emprunts = Auth::user()->emprunts;
        }
        
        return view('emprunts.index', compact('emprunts'));
    }
    

    public function validerRetour($emprunt_id)
    {
        $emprunt = Emprunt::findOrFail($emprunt_id);
        $document_id = $emprunt->document_id;
        $document = Document::findOrFail($document_id);
        $document->nombre_de_copies++;
    
        $emprunt->delete();
    
        $document->save();
    
        return back()->with('success', 'Retour validé avec succès.');
    }
    
    
}
