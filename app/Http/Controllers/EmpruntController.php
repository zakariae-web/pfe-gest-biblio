<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprunt;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\Réservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThankYouForReturning;
use App\Mail\ReminderEmail;
use Carbon\Carbon;
use App\Models\User;


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

        $userEmail = $emprunt->user->email;
        $userName = $emprunt->user->name;
        $bookName = $document->titre;
        
        Mail::to($userEmail)->send(new ThankYouForReturning($userName, $bookName));
    
    
        return back()->with('success', 'Retour validé avec succès.');
    }

    public function sendReminderEmails()
{
    $emprunts = Emprunt::where('date_retour', '>=', Carbon::now()->subDays(1))
                    ->where('date_retour', '<=', Carbon::now()->addDays(1))
                    ->get();

    $users = [];

    foreach ($emprunts as $emprunt) {
        $user = $emprunt->user;
        if (!in_array($user, $users)) {
            $users[] = $user;
        }
    }

    return view('admin.reminder-emails')->with('users', $users);
}

public function sendEmails(Request $request)
{
    
    $userIds = $request->input('users');
    $users = User::whereIn('id', $userIds)->get();

    foreach ($users as $user) {
        $userName = $user->name;
        
        Mail::to($user->email)->send(new ReminderEmail($userName));
    }

    return redirect()->back()->with('success', 'Reminder emails sent successfully!');
}


}
