<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Réservation;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reservation.index',
        ['reservation' => Réservation::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documents = Document::all();
        return view('reservation.create', compact('documents'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        // Vérifier si la date de fin est supérieure à la date de début
        if ($end_date <= $start_date) {
            return redirect()->back()->with('error', 'La date de fin doit être supérieure à la date de début.');
        }
        $user_id = Auth::id();
        $user = User::find($user_id);
    
        // Récupérer le type d'utilisateur
        $user_type = $user->role;
        $max_reservations = 2;
    
        // Vérifier le nombre de réservations actives de l'utilisateur
        $active_reservations_count = $user->reservations()->where('is_active', 1)->count();
    
        // Déterminer la limite de réservations pour ce type d'utilisateur
        if ($user_type == 'etudiant') {
            $max_reservations = 2;
        } elseif ($user_type == 'enseignant') {
            $max_reservations = 4;
        }
    
        // Vérifier si l'utilisateur a atteint la limite de réservations
        if ($active_reservations_count >= $max_reservations) {
            return redirect()->back()->with('error', 'Vous avez atteint la limite de réservations pour votre type d\'utilisateur.');
        }
    
        // Continuer avec la création de la réservation
        $reservation = new Réservation();
    
        $reservation->user_id = $request->input('user_id');
        $reservation->document_id = $request->input('document_id');
        $reservation->start_date = $request->input('start_date');
        $reservation->end_date = $request->input('end_date');
        $reservation->is_active = true;

        $reservation->save();
        
        return redirect()->route('reservation.index');
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
        $reservation = Réservation::findorfail($id);
        return view('reservation.edit', [
            'reservation' => $reservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Réservation::findorfail($id);

        
        $reservation->user_id = $request->input('user_id');
        $reservation->document_id = $request->input('document_id');
        $reservation->start_date = $request->input('start_date');
        $reservation->end_date = $request->input('end_date');
        $reservation->is_active = true;

        $reservation->save();
        
        return redirect()->route('reservation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Réservation::findorfail($id);
        $reservation->delete();
        return redirect()->route('reservation.index');
    }
}
