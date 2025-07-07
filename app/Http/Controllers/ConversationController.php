<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ChatMessage;
use App\Models\Etudiant;
use App\Models\Encadrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function etudiantChat()
    {
        $etudiant = Etudiant::where('user_id', Auth::id())->firstOrFail();

        // Trouve ou crée la conversation entre cet étudiant et son encadrant
        $conversation = Conversation::firstOrCreate(
            ['etudiant_id' => $etudiant->id],
            ['encadrant_id' => $etudiant->encadrant_id]
        );

        $messages = $conversation->messages()->with('user')->get();

        return view('etudiant.chat', compact('conversation', 'messages'));
    }

    public function encadrantConversations()
    {
        $encadrant = Encadrant::where('user_id', Auth::id())->firstOrFail();

        $conversations = Conversation::where('encadrant_id', $encadrant->id)
            ->with('etudiant')
            ->get();

        return view('encadrant.conversations', compact('conversations'));
    }

    public function encadrantChat($id)
    {
        $conversation = Conversation::with(['messages.user', 'etudiant'])->findOrFail($id);

        return view('encadrant.chat', compact('conversation'));
    }

    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate(['contenu' => 'required|string']);

        $conversation = Conversation::findOrFail($conversationId);

        ChatMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'contenu' => $request->contenu,
        ]);

        return redirect()->back();
    }
}