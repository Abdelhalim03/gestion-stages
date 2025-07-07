<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                    <i class="fas fa-file-alt"></i>
                </span>
                Informations du PFE
            </h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('etudiant.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600">
                            <i class="fas fa-home mr-2"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('etudiant.pfe.indexpfe') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600">
                            PFE
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Informations</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Section Informations actuelles -->
            @if ($etudiant->titre_pfe)
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    Informations actuelles
                </h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Titre du projet</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $etudiant->titre_pfe }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Durée</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $etudiant->duree_pfe }}</p>
                    </div>
                    <div class="md:col-span-3">
                        <p class="text-sm font-medium text-gray-500">Sujet</p>
                        <p class="text-sm text-gray-900">{{ $etudiant->sujet_pfe }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Formulaire -->
            <div class="px-6 py-4">
                <h3 class="text-lg font-medium text-gray-900 flex items-center mb-6">
                    <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                        <i class="fas fa-edit"></i>
                    </span>
                    {{ $etudiant->titre_pfe ? 'Modifier les informations' : 'Ajouter les informations' }}
                </h3>

                <form method="POST" action="{{ route('etudiant.pfe.updateInfo') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Titre du projet -->
                    <div>
                        <label for="titre_pfe" class="block text-sm font-medium text-gray-700 mb-1">
                            <span class="text-red-500">*</span> Titre du projet
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                <i class="fas fa-heading"></i>
                            </div>
                            <input type="text" id="titre_pfe" name="titre_pfe" value="{{ old('titre_pfe', $etudiant->titre_pfe) }}"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                                   placeholder="Titre de votre projet" required>
                        </div>
                        @error('titre_pfe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durée -->
                    <div>
                        <label for="duree_pfe" class="block text-sm font-medium text-gray-700 mb-1">
                            <span class="text-red-500">*</span> Durée
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <input type="text" id="duree_pfe" name="duree_pfe" value="{{ old('duree_pfe', $etudiant->duree_pfe) }}"
                                   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                                   placeholder="Ex: 6 mois, du 01/01 au 30/06" required>
                        </div>
                        @error('duree_pfe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sujet -->
                    <div>
                        <label for="sujet_pfe" class="block text-sm font-medium text-gray-700 mb-1">
                            <span class="text-red-500">*</span> Sujet
                        </label>
                        <div class="mt-1">
                            <textarea id="sujet_pfe" name="sujet_pfe" rows="5"
                                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                                      placeholder="Décrivez en détail votre projet de fin d'études" required>{{ old('sujet_pfe', $etudiant->sujet_pfe) }}</textarea>
                        </div>
                        @error('sujet_pfe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a href="{{ route('etudiant.pfe.indexpfe') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-save mr-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>