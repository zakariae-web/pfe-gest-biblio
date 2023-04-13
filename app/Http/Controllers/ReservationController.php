<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Réservation;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Adhérant;
use App\Jobs\DeleteReservation;
use Illuminate\Support\Str;




class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $reservations = Réservation::all();
        } else {
            $reservations = Auth::user()->reservations;
        }
        
        $search = $request->input('search');
        
        if (!empty($search)) {
            $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
            $reservations = $reservations->whereIn('user_id', $users->pluck('id'));
        }
        
        return view('reservation.index', compact('reservations'));
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
        $user_id = Auth::id();
        $user = User::find($user_id);
    
        // Récupérer le type d'utilisateur
        $user_type = $user->role;
        $max_reservations = 2;
    
        $active_reservations_count = $user->reservations()->where('is_active', 1)->count();
    
        if ($user_type == 'etudiant') {
            $max_reservations = 2;
        } elseif ($user_type == 'enseignant') {
            $max_reservations = 4;
        }
    
        if ($active_reservations_count >= $max_reservations) {
            return redirect()->back()->with('error', 'Vous avez atteint la limite de réservations pour votre type d\'utilisateur.');
        }
    
        $reservation = new Réservation();
    
        $reservation->user_id = $request->input('user_id');
        $reservation->document_id = $request->input('document_id');
        $reservation->is_active = true;
        $this->reserverDocument($reservation->document_id);
    
        $reservation->save();
    

    
        return redirect()->route('reservation.create')->with('success', 'La réservation a été effectuée avec succès.');
        }

    public function reserverDocument($document_id)
    {
        $document = Document::find($document_id);
    
        $document->nombre_de_copies--;
        $document->save();
    
        return redirect()->back()->with('success', 'La réservation a été effectuée avec succès.');    
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $this->authorize('manage-documents');
    $reservation = Réservation::findorfail($id);
    $document_id = $reservation->document_id; // retrieve the document ID from the reservation
    $reservation->delete();

    $document = Document::find($document_id);
    $document->nombre_de_copies++;
    $document->save();
    return redirect()->route('reservation.index');
}
}
