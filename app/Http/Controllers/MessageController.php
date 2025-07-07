<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Etudiant;
use App\Models\Encadrant;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Étudiant envoie un message
    public function envoyer(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        $etudiant = Etudiant::where('user_id', Auth::id())->firstOrFail();
        $message = Message::create([
            'etudiant_id' => $etudiant->id,
            'encadrant_id' => $etudiant->encadrant_id,
            'contenu' => $request->contenu,
        ]);

        return back()->with('success', 'Message envoyé à votre encadrant.');
    }

    // Encadrant voit les messages
    public function boite()
    {
        $encadrant = Encadrant::where('user_id', Auth::id())->firstOrFail();
        $messages = Message::where('encadrant_id', $encadrant->id)->with('etudiant')->get();

        return view('encadrant.boite', compact('messages'));
    }

    // Encadrant répond à un message
    public function repondre(Request $request, $id)
    {
        $request->validate([
            'reponse' => 'required|string',
        ]);

        $message = Message::findOrFail($id);
        $message->reponse = $request->reponse;
        $message->save();

        return back()->with('success', 'Réponse envoyée.');
    }
}

