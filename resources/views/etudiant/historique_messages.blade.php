<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <!-- En-tête avec icône -->
        <div class="flex items-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <h2 class="text-3xl font-bold text-gray-800">Historique de mes échanges</h2>
        </div>

        @if($messages->isEmpty())
            <!-- État vide -->
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="mt-4 text-lg text-gray-600">Aucun message échangé avec l'encadrant</p>
                <p class="text-gray-500">Envoyez votre premier message pour commencer la discussion</p>
            </div>
        @else
            <!-- Liste des messages -->
            <div class="space-y-6">
                @foreach ($messages as $message)
                    <!-- Message utilisateur -->
                    <div class="flex flex-col items-end">
                        <div class="max-w-xs md:max-w-md lg:max-w-lg bg-indigo-600 text-white p-4 rounded-t-2xl rounded-l-2xl shadow-md">
                            <p class="whitespace-pre-wrap">{{ $message->contenu }}</p>
                            <p class="text-xs text-indigo-200 mt-1 text-right">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">Vous</span>
                    </div>

                    <!-- Réponse ou état d'attente -->
                    @if ($message->reponse)
                        <div class="flex flex-col items-start">
                            <div class="max-w-xs md:max-w-md lg:max-w-lg bg-gray-100 p-4 rounded-t-2xl rounded-r-2xl shadow-md">
                                <p class="whitespace-pre-wrap text-gray-800">{{ $message->reponse }}</p>
                                <p class="text-xs text-gray-500 mt-1">Réponse de l'encadrant</p>
                            </div>
                            <span class="text-xs text-gray-500 mt-1">Encadrant</span>
                        </div>
                    @else
                        <div class="flex items-center justify-start space-x-2 bg-amber-50 p-3 rounded-lg border border-amber-200 max-w-max">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-amber-700 text-sm">En attente de réponse</span>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>