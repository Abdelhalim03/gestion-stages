<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-graduation-cap"></i>
                </span>
                Gestion de mon PFE
            </h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('etudiant.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600">
                            <i class="fas fa-home mr-2"></i> Tableau de bord
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">PFE</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Alertes -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Grille principale -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Colonne de gauche -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Carte Informations étudiant -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-user-graduate"></i>
                            </span>
                            Mes informations
                        </h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-gray-500">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Nom complet</p>
                                    <p class="text-sm text-gray-900">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-gray-500">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Email</p>
                                    <p class="text-sm text-gray-900">{{ $etudiant->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-gray-500">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Filière</p>
                                    <p class="text-sm text-gray-900">{{ $etudiant->filiere }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 text-gray-500">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Niveau</p>
                                    <p class="text-sm text-gray-900">{{ $etudiant->niveau }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Dépôt de rapport -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-file-upload"></i>
                            </span>
                            Dépôt du rapport PFE
                        </h3>
                    </div>
                    <div class="px-6 py-4">
                        <form method="POST" action="{{ route('etudiant.pfe.store') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div>
                                <label for="rapport_pfe" class="block text-sm font-medium text-gray-700 mb-1">
                                    Rapport PFE (PDF)
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <div class="flex text-sm text-gray-600">
                                            <label for="rapport_pfe" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                <span>Téléverser un fichier</span>
                                                <input id="rapport_pfe" name="rapport_pfe" type="file" accept="application/pdf" class="sr-only">
                                            </label>
                                            <p class="pl-1">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF jusqu'à 10MB</p>
                                    </div>
                                </div>
                                @error('rapport_pfe')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <i class="fas fa-paper-plane mr-2"></i> Envoyer le rapport
                                </button>
                            </div>
                        </form>

                        @if ($etudiant->rapport_pfe)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Rapport déposé</h4>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 text-green-600">
                                    <i class="fas fa-file-pdf text-2xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $etudiant->rapport_pfe }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Dernière modification : {{ \Carbon\Carbon::parse($etudiant->updated_at)->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ asset('storage/' . $etudiant->rapport_pfe) }}" target="_blank" class="p-2 rounded-full text-green-600 hover:bg-green-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ asset('storage/' . $etudiant->rapport_pfe) }}" download class="p-2 rounded-full text-indigo-600 hover:bg-indigo-50">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Carte Présentation -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-file-powerpoint"></i>
                            </span>
                            Présentation de soutenance
                        </h3>
                    </div>
                    <div class="px-6 py-4">
                        <form method="POST" action="{{ route('etudiant.presentation.upload') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <div>
                                <label for="presentation" class="block text-sm font-medium text-gray-700 mb-1">
                                    Fichier de présentation (PPT/PDF)
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <div class="flex text-sm text-gray-600">
                                            <label for="presentation" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                <span>Téléverser un fichier</span>
                                                <input id="presentation" name="presentation" type="file" accept=".ppt,.pptx,.pdf" class="sr-only">
                                            </label>
                                            <p class="pl-1">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PPT/PDF jusqu'à 20MB</p>
                                    </div>
                                </div>
                                @error('presentation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    <i class="fas fa-paper-plane mr-2"></i> Envoyer la présentation
                                </button>
                            </div>
                        </form>

                        @if ($etudiant->presentation)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Présentation déposée</h4>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 text-purple-600">
                                    <i class="fas fa-file-powerpoint text-2xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $etudiant->presentation }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Dernière modification : {{ \Carbon\Carbon::parse($etudiant->updated_at)->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ asset('presentations/' . $etudiant->presentation) }}" download class="p-2 rounded-full text-purple-600 hover:bg-purple-50">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="space-y-6">
                <!-- Carte Statut -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            Statut des documents
                        </h3>
                    </div>
                    <div class="px-6 py-4 space-y-4">
                        <!-- Rapport -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Rapport PFE</h4>
                            <div class="flex items-center justify-between">
                                @if ($etudiant->statut_rapport_pfe)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $etudiant->statut_rapport_pfe == 'valide' ? 'bg-green-100 text-green-800' : 
                                           ($etudiant->statut_rapport_pfe == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        @if ($etudiant->statut_rapport_pfe == 'valide')
                                            <i class="fas fa-check-circle mr-1"></i> Validé
                                        @elseif ($etudiant->statut_rapport_pfe == 'refuse')
                                            <i class="fas fa-times-circle mr-1"></i> Refusé
                                        @else
                                            <i class="fas fa-clock mr-1"></i> En attente
                                        @endif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-question-circle mr-1"></i> Non soumis
                                    </span>
                                @endif
                                <button onclick="showModal('rapport')" class="text-sm text-indigo-600 hover:text-indigo-500">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Présentation -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Présentation</h4>
                            <div class="flex items-center justify-between">
                                @if ($etudiant->statut_presentation)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $etudiant->statut_presentation == 'valide' ? 'bg-green-100 text-green-800' : 
                                           ($etudiant->statut_presentation == 'refuse' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        @if ($etudiant->statut_presentation == 'valide')
                                            <i class="fas fa-check-circle mr-1"></i> Validé
                                        @elseif ($etudiant->statut_presentation == 'refuse')
                                            <i class="fas fa-times-circle mr-1"></i> Refusé
                                        @else
                                            <i class="fas fa-clock mr-1"></i> En attente
                                        @endif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-question-circle mr-1"></i> Non soumis
                                    </span>
                                @endif
                                <button onclick="showModal('presentation')" class="text-sm text-indigo-600 hover:text-indigo-500">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Commentaires -->
                @if ($etudiant->commentaire_rapport_pfe || $etudiant->commentaire_presentation)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                                <i class="fas fa-comment-dots"></i>
                            </span>
                            Commentaires
                        </h3>
                    </div>
                    <div class="px-6 py-4 space-y-4">
                        @if ($etudiant->commentaire_rapport_pfe)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Sur le rapport</h4>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-800">{{ $etudiant->commentaire_rapport_pfe }}</p>
                            </div>
                        </div>
                        @endif

                        @if ($etudiant->commentaire_presentation)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Sur la présentation</h4>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-sm text-gray-800">{{ $etudiant->commentaire_presentation }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Bouton Infos PFE -->
                <a href="{{ route('etudiant.pfe.edit') }}" class="block w-full bg-white shadow rounded-lg overflow-hidden hover:shadow-md transition">
                    <div class="px-6 py-4 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                            <i class="fas fa-edit"></i>
                        </span>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informations du PFE</h3>
                            <p class="text-sm text-gray-500">Compléter/modifier les détails</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="modalPFE" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Détail du statut</h3>
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="px-6 py-4">
                <p id="modalMessage" class="text-gray-800"></p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 text-right">
                <button onclick="closeModal()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Fermer
                </button>
            </div>
        </div>
    </div>

    <script>
        function showModal(type) {
            let message = '';
            let statut = '';
            let commentaire = '';

            if (type === 'rapport') {
                statut = '{{ $etudiant->statut_rapport_pfe }}';
                commentaire = '{{ $etudiant->commentaire_rapport_pfe }}';
            } else {
                statut = '{{ $etudiant->statut_presentation }}';
                commentaire = '{{ $etudiant->commentaire_presentation }}';
            }

            if (statut === 'valide') {
                message = `<div class="flex items-start">
                    <div class="flex-shrink-0 text-green-500 mt-1">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">Votre ${type} a été validé par votre encadrant.</p>
                        ${commentaire ? `<p class="mt-2 text-sm text-gray-700"><span class="font-medium">Commentaire :</span> ${commentaire}</p>` : ''}
                    </div>
                </div>`;
            } else if (statut === 'refuse') {
                message = `<div class="flex items-start">
                    <div class="flex-shrink-0 text-red-500 mt-1">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">Votre ${type} a été refusé. Merci de le corriger.</p>
                        ${commentaire ? `<p class="mt-2 text-sm text-gray-700"><span class="font-medium">Commentaire :</span> ${commentaire}</p>` : ''}
                    </div>
                </div>`;
            } else {
                message = `<div class="flex items-start">
                    <div class="flex-shrink-0 text-yellow-500 mt-1">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-yellow-800">Votre ${type} est en attente de validation.</p>
                    </div>
                </div>`;
            }

            document.getElementById('modalMessage').innerHTML = message;
            document.getElementById('modalPFE').classList.remove('hidden');
            document.getElementById('modalPFE').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalPFE').classList.add('hidden');
            document.getElementById('modalPFE').classList.remove('flex');
        }
    </script>
</x-app-layout>