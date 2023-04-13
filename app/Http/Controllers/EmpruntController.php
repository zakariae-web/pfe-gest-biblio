<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprunt;
use Illuminate\Support\Facades\Auth;


class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vérifier si l'utilisateur connecté est un administrateur
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
    
        $emprunt->delete();
    
    
        return back()->with('success', 'Retour validé avec succès.');
    }
    
    
}
