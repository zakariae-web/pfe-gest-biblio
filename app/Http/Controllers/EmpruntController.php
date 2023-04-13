<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprunt;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprunts = Emprunt::all();
        return view('emprunts.index', compact('emprunts'));
    }

    public function validerRetour($emprunt_id)
    {
        $emprunt = Emprunt::findOrFail($emprunt_id);
    
        $emprunt->delete();
    
    
        return back()->with('success', 'Retour validé avec succès.');
    }
    
    
}
