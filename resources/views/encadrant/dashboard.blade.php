<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Tableau de Bord Encadrant</h1>
                        <p class="mt-2 text-blue-100 max-w-2xl">Gestion des étudiants et suivi des stages en temps réel</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                            <div class="bg-white/20 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-blue-100">Encadrant • {{ $encadrant->specialite ?? 'Non spécifié' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($encadrant)
            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-blue-500">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500 truncate">Étudiants assignés</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $encadrant->etudiants->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-green-500">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500 truncate">Rapports validés</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $encadrant->etudiants->where('statut_rapport', 'valide')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-yellow-500">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500 truncate">En attente</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $encadrant->etudiants->where('statut_rapport', 'en_attente')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-red-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p class="text-sm font-medium text-gray-500 truncate">Rapports refusés</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $encadrant->etudiants->where('statut_rapport', 'refuse')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Student List -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Search and Filters -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Filtrer les étudiants</h2>
                            <form method="GET">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="text" name="search" id="search" placeholder="Nom, email..." value="{{ request('search') }}"
                                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="filiere" class="block text-sm font-medium text-gray-700 mb-1">Filière</label>
                                        <select id="filiere" name="filiere" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="">Toutes filières</option>
                                            @foreach(['Genie', 'dl2ss', 'devellopement', 'gestion des entreprises'] as $filiere)
                                                <option value="{{ $filiere }}" {{ request('filiere') == $filiere ? 'selected' : '' }}>{{ $filiere }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="niveau" class="block text-sm font-medium text-gray-700 mb-1">Niveau</label>
                                        <select id="niveau" name="niveau" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="">Tous niveaux</option>
                                            @foreach(['Licence', 'Master', 'Doctorat'] as $niveau)
                                                <option value="{{ $niveau }}" {{ request('niveau') == $niveau ? 'selected' : '' }}>{{ $niveau }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                    <div>
                                        <label for="statut_rapport" class="block text-sm font-medium text-gray-700 mb-1">Statut Rapport</label>
                                        <select id="statut_rapport" name="statut_rapport" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="">Tous statuts</option>
                                            <option value="valide" {{ request('statut_rapport') == 'valide' ? 'selected' : '' }}>Validé</option>
                                            <option value="refuse" {{ request('statut_rapport') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                                            <option value="en_attente" {{ request('statut_rapport') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="statut_presentation" class="block text-sm font-medium text-gray-700 mb-1">Statut Présentation</label>
                                        <select id="statut_presentation" name="statut_presentation" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                            <option value="">Tous statuts</option>
                                            <option value="valide" {{ request('statut_presentation') == 'valide' ? 'selected' : '' }}>Validé</option>
                                            <option value="refuse" {{ request('statut_presentation') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                                            <option value="en_attente" {{ request('statut_presentation') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                        </select>
                                    </div>
                                    <div class="flex items-end space-x-2">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                            </svg>
                                            Filtrer
                                        </button>
                                        <a href="{{ route('encadrant.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Réinitialiser
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Student List -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-800">Étudiants Assignés</h2>
                            
                            @forelse ($encadrant->etudiants as $etudiant)
                                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-start justify-between">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                                                        {{ substr($etudiant->nom, 0, 1) }}{{ substr($etudiant->prenom, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-medium text-gray-900">{{ $etudiant->nom }} {{ $etudiant->prenom }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $etudiant->email }}</p>
                                                    <p class="text-sm text-gray-500 mt-1">{{ $etudiant->filiere }} - {{ $etudiant->niveau }}</p>
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $etudiant->statut_rapport == 'valide' ? 'bg-green-100 text-green-800' : ($etudiant->statut_rapport == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ $etudiant->statut_rapport == 'valide' ? 'Rapport validé' : ($etudiant->statut_rapport == 'refuse' ? 'Rapport refusé' : 'Rapport en attente') }}
                                                </span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $etudiant->statut_presentation == 'valide' ? 'bg-green-100 text-green-800' : ($etudiant->statut_presentation == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ $etudiant->statut_presentation == 'valide' ? 'Présentation validée' : ($etudiant->statut_presentation == 'refuse' ? 'Présentation refusée' : 'Présentation en attente') }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        @if ($etudiant->entreprise || $etudiant->duree || $etudiant->sujet)
                                            <div class="mt-4 border-t pt-4">
                                                <h4 class="text-sm font-medium text-gray-900 mb-2">Informations de Stage</h4>
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div>
                                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Entreprise</p>
                                                        <p class="font-medium">{{ $etudiant->entreprise ?? 'Non spécifié' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</p>
                                                        <p class="font-medium">{{ $etudiant->duree ?? 'Non spécifié' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</p>
                                                        <p class="font-medium">{{ $etudiant->sujet ?? 'Non spécifié' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- Documents Section -->
                                        <div class="mt-4 border-t pt-4">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <!-- Rapport -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h4 class="text-sm font-medium text-gray-900">Rapport de Stage</h4>
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $etudiant->statut_rapport == 'valide' ? 'bg-green-100 text-green-800' : ($etudiant->statut_rapport == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                            {{ $etudiant->statut_rapport == 'valide' ? 'Validé' : ($etudiant->statut_rapport == 'refuse' ? 'Refusé' : 'En attente') }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if ($etudiant->rapport)
                                                        <div class="flex items-center space-x-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                            </svg>
                                                            <a href="{{ asset('rapports/' . $etudiant->rapport) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">Télécharger le rapport</a>
                                                        </div>
                                                    @else
                                                        <p class="text-sm text-gray-500">Aucun rapport déposé</p>
                                                    @endif
                                                    
                                                    <form method="POST" action="{{ route('encadrants.updateStatutRapport', $etudiant->id) }}" class="mt-3">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="flex items-center space-x-2">
                                                            <select name="statut_rapport" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                                <option value="en_attente" {{ $etudiant->statut_rapport == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                                <option value="valide" {{ $etudiant->statut_rapport == 'valide' ? 'selected' : '' }}>Validé</option>
                                                                <option value="refuse" {{ $etudiant->statut_rapport == 'refuse' ? 'selected' : '' }}>Refusé</option>
                                                            </select>
                                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Mettre à jour
                                                            </button>
                                                        </div>
                                                    </form>
                                                    
                                                    <form method="POST" action="{{ route('encadrants.updateCommentaireRapport', $etudiant->id) }}" class="mt-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="commentaire_rapport_{{ $etudiant->id }}" class="block text-xs font-medium text-gray-700">Commentaire</label>
                                                        <textarea name="commentaire_rapport" id="commentaire_rapport_{{ $etudiant->id }}" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $etudiant->commentaire_rapport }}</textarea>
                                                        <button type="submit" class="mt-1 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Enregistrer
                                                        </button>
                                                    </form>
                                                </div>
                                                
                                                <!-- Présentation -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h4 class="text-sm font-medium text-gray-900">Présentation</h4>
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $etudiant->statut_presentation == 'valide' ? 'bg-green-100 text-green-800' : ($etudiant->statut_presentation == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                            {{ $etudiant->statut_presentation == 'valide' ? 'Validée' : ($etudiant->statut_presentation == 'refuse' ? 'Refusée' : 'En attente') }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if ($etudiant->presentation)
                                                        <div class="flex items-center space-x-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                            </svg>
                                                            <a href="{{ asset('presentations/' . $etudiant->presentation) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">Télécharger la présentation</a>
                                                        </div>
                                                    @else
                                                        <p class="text-sm text-gray-500">Aucune présentation déposée</p>
                                                    @endif
                                                    
                                                    <form method="POST" action="{{ route('encadrants.updateStatutPresentation', $etudiant->id) }}" class="mt-3">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="flex items-center space-x-2">
                                                            <select name="statut_presentation" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                                <option value="en_attente" {{ $etudiant->statut_presentation == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                                <option value="valide" {{ $etudiant->statut_presentation == 'valide' ? 'selected' : '' }}>Validée</option>
                                                                <option value="refuse" {{ $etudiant->statut_presentation == 'refuse' ? 'selected' : '' }}>Refusée</option>
                                                            </select>
                                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Mettre à jour
                                                            </button>
                                                        </div>
                                                    </form>
                                                    
                                                    <form method="POST" action="{{ route('encadrants.updateCommentairePresentation', $etudiant->id) }}" class="mt-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="commentaire_presentation_{{ $etudiant->id }}" class="block text-xs font-medium text-gray-700">Commentaire</label>
                                                        <textarea name="commentaire_presentation" id="commentaire_presentation_{{ $etudiant->id }}" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $etudiant->commentaire_presentation }}</textarea>
                                                        <button type="submit" class="mt-1 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                            Enregistrer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun étudiant assigné</h3>
                                    <p class="mt-2 text-sm text-gray-500">Vous n'avez actuellement aucun étudiant assigné à superviser.</p>
                                    <div class="mt-6">
                                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Demander des étudiants
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right Column - Summary and Charts -->
                    <div class="space-y-6">
                        <!-- Dates Limites Card -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Dates Importantes</h2>
                            <form method="POST" action="{{ route('encadrant.dates.update') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="date_limite_rapport" class="block text-sm font-medium text-gray-700">Date limite dépôt rapport</label>
                                        <input type="date" name="date_limite_rapport" id="date_limite_rapport" value="{{ $encadrant->date_limite_rapport }}"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="date_soutenance" class="block text-sm font-medium text-gray-700">Date de soutenance</label>
                                        <input type="date" name="date_soutenance" id="date_soutenance" value="{{ $encadrant->date_soutenance }}"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>
                                    <div class="pt-2">
                                        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Enregistrer les dates
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <!-- Charts -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Répartition par Filière</h2>
                            <div class="h-64">
                                <canvas id="pieChart" class="w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Status Chart -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Statut des Rapports</h2>
                            <div class="h-64">
                                <canvas id="statusChart" class="w-full h-full"></canvas>
                            </div>
                        </div>
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex justify-end">
        <a href="{{ route('encadrant.show', $encadrant->id) }}" 
           class="flex items-center justify-center space-x-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-medium py-3 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Voir mes informations détaillées</span>
        </a>
    </div>
</div>
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Profil incomplet</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <p>Vous devez compléter votre profil avant d'accéder au dashboard. <a href="{{ route('encadrant.create') }}" class="font-medium underline text-red-800 hover:text-red-600">Cliquez ici pour compléter votre profil</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    
                       <!-- Summary Table - Version sans scroll -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Résumé des Étudiants</h2>
        <div class="w-full">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Filière</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Niveau</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut Rapport</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut Présentation</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($encadrant->etudiants as $etudiant)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $etudiant->nom }} {{ $etudiant->prenom }}</div>
                                <div class="text-sm text-gray-500">{{ $etudiant->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $etudiant->filiere }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $etudiant->niveau }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $etudiant->statut_rapport == 'valide' ? 'bg-green-100 text-green-800' : ($etudiant->statut_rapport == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $etudiant->statut_rapport == 'valide' ? 'Validé' : ($etudiant->statut_rapport == 'refuse' ? 'Refusé' : 'En attente') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $etudiant->statut_presentation == 'valide' ? 'bg-green-100 text-green-800' : ($etudiant->statut_presentation == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $etudiant->statut_presentation == 'valide' ? 'Validée' : ($etudiant->statut_presentation == 'refuse' ? 'Refusée' : 'En attente') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                Aucun étudiant assigné
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div><br>
    

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-white rounded-xl shadow-md mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Mes Étudiants et leurs Projets</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Validation Admin</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($etudiants as $etudiant)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold mr-4">
                                {{ substr($etudiant->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $etudiant->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $etudiant->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-normal">
                        <div class="text-sm text-gray-900 font-medium">{{ $etudiant->sujet ?? '—' }}</div>
                        @if($etudiant->entreprise)
                        <div class="text-sm text-gray-500 mt-1">{{ $etudiant->entreprise }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($etudiant->validation_admin === 'validé')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <svg class="-ml-1 mr-1.5 h-2 w-2 text-green-800" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                Validé
                            </span>
                        @elseif($etudiant->validation_admin === 'refusé')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                <svg class="-ml-1 mr-1.5 h-2 w-2 text-red-800" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                Refusé
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <svg class="-ml-1 mr-1.5 h-2 w-2 text-yellow-800" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                                En attente
                            </span>
                        @endif
                    </td>
                   
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center">
                        <div class="flex flex-col items-center justify-center py-8 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-lg font-medium">Aucun étudiant encadré</span>
                            <p class="text-sm mt-1">Vous n'avez actuellement aucun étudiant assigné</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>





    @if ($encadrant)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pie Chart - Répartition par Filière
                const pieCtx = document.getElementById('pieChart').getContext('2d');
                
                // Group students by filiere
                const filieres = {};
                @foreach($encadrant->etudiants as $etudiant)
                    if (!filieres['{{ $etudiant->filiere }}']) {
                        filieres['{{ $etudiant->filiere }}'] = 0;
                    }
                    filieres['{{ $etudiant->filiere }}']++;
                @endforeach
                
                const pieLabels = Object.keys(filieres);
                const pieData = Object.values(filieres);
                
                const pieChart = new Chart(pieCtx, {
                    type: 'pie',
                    data: {
                        labels: pieLabels,
                        datasets: [{
                            data: pieData,
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(16, 185, 129, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(139, 92, 246, 0.7)',
                                'rgba(239, 68, 68, 0.7)'
                            ],
                            borderColor: '#fff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 20,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });

                // Status Chart - Statut des Rapports
                const statusCtx = document.getElementById('statusChart').getContext('2d');
                
                const statusData = {
                    valide: {{ $encadrant->etudiants->where('statut_rapport', 'valide')->count() }},
                    en_attente: {{ $encadrant->etudiants->where('statut_rapport', 'en_attente')->count() }},
                    refuse: {{ $encadrant->etudiants->where('statut_rapport', 'refuse')->count() }}
                };
                
                const statusChart = new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Validés', 'En attente', 'Refusés'],
                        datasets: [{
                            data: [statusData.valide, statusData.en_attente, statusData.refuse],
                            backgroundColor: [
                                'rgba(16, 185, 129, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(239, 68, 68, 0.7)'
                            ],
                            borderColor: '#fff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 12,
                                    padding: 20,
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif


   

</x-app-layout>