<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- En-tête avec bouton de retour et titre -->
            <div class="flex items-center mb-8">
                <a href="{{ route('etudiant.stage.indexstage') }}" class="mr-4 p-2 rounded-full hover:bg-gray-100 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900">Historique des Commentaires</h1>
            </div>

            <!-- Carte principale -->
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <!-- En-tête de la carte -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-white">Tous les commentaires</h2>
                        <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-sm font-medium">
                            {{ count($historiquesCommentaires) }} {{ Str::plural('commentaire', count($historiquesCommentaires)) }}
                        </span>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="divide-y divide-gray-200">
                    @if($historiquesCommentaires->isEmpty())
                        <div class="p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Aucun commentaire</h3>
                            <p class="mt-1 text-gray-500">Aucun commentaire n'a été enregistré pour le moment.</p>
                        </div>
                    @else
                        @foreach($historiquesCommentaires as $historique)
                            <div class="p-6 hover:bg-gray-50 transition duration-150">
                                <div class="flex space-x-4">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- Contenu du commentaire -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ optional($historique->encadrant->user)->name ?? 'Encadrant' }}
                                            </p>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $historique->created_at->format('d/m/Y à H:i') }}
                                            </div>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-700 space-y-2">
                                            <p>{{ $historique->commentaire }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Pagination (optionnel) -->
               
            </div>
        </div>
    </div>
</x-app-layout>