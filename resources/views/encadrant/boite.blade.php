<x-app-layout>

<div class="max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Boîte de réception</h2>

    @foreach ($messages as $message)
        <div class="bg-white border rounded p-4 mb-4 shadow-sm">
            <p><strong>Étudiant :</strong> {{ $message->etudiant->email }}</p>
            <p><strong>Message :</strong> {{ $message->contenu }}</p>

            @if($message->reponse)
                <p class="mt-2 text-green-700"><strong>Réponse :</strong> {{ $message->reponse }}</p>
            @else
                <form action="{{ route('encadrant.message.repondre', $message->id) }}" method="POST" class="mt-3">
                    @csrf
                    <textarea name="reponse" class="w-full border p-2 rounded" rows="3" placeholder="Écrivez votre réponse..." required></textarea>
                    <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded mt-2 hover:bg-green-600">Répondre</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
</x-app-layout>
