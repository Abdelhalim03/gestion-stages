<x-app-layout>


        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-primary-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white">
                            <i class="fas fa-user-graduate mr-2"></i> Formulaire Étudiant
                        </h2>
                        <a href="{{ route('etudiant.dashboard') }}" class="text-white hover:text-gray-200 text-sm font-medium flex items-center">
                            <i class="fas fa-arrow-left mr-1"></i> Retour au tableau de bord
                        </a>
                    </div>
                    <p class="text-primary-100 mt-1">Veuillez remplir tous les champs obligatoires</p>
                </div>

                <!-- Form Body -->
                <form method="POST" action="{{ route('etudiants.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    <!-- Filière -->
                    <div class="space-y-2">
                        <label for="filiere" class="block text-sm font-medium text-gray-700">
                            Filière <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="filiere" id="filiere" required
                            class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                            placeholder="Ex: Informatique, Gestion, etc.">
                        @error('filiere')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Niveau -->
                    <div class="space-y-2">
                        <label for="niveau" class="block text-sm font-medium text-gray-700">
                            Niveau <span class="text-red-500">*</span>
                        </label>
                        <select name="niveau" id="niveau" required
                            class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                            <option value="">-- Sélectionnez votre niveau --</option>
                            <option value="2ème année">2ème année</option>
                            <option value="Licence">Licence</option>
                            <option value="Master">Master</option>
                        </select>
                        @error('niveau')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div class="space-y-2">
                        <label for="telephone" class="block text-sm font-medium text-gray-700">
                            Téléphone <span class="text-red-500">*</span>
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-500">+212</span>
                            </div>
                            <input type="text" name="telephone" id="telephone" required
                                class="form-input block w-full pl-14 rounded-md border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                placeholder="600000000">
                        </div>
                        @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" required
                            class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                            placeholder="votre@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Établissement -->
                    <div class="space-y-2">
                        <label for="etablissement" class="block text-sm font-medium text-gray-700">
                            Établissement <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="etablissement" id="etablissement" required
                            class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                            placeholder="Nom de votre établissement">
                        @error('etablissement')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Encadrant -->
                    <div class="space-y-2">
                        <label for="encadrant_id" class="block text-sm font-medium text-gray-700">
                            Encadrant <span class="text-red-500">*</span>
                        </label>
                        <select name="encadrant_id" id="encadrant_id" required
                            class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                            <option value="">-- Sélectionnez un encadrant --</option>
                            @foreach($encadrants as $encadrant)
                                <option value="{{ $encadrant->id }}" {{ old('encadrant_id') == $encadrant->id ? 'selected' : '' }}>
                                    {{ $encadrant->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('encadrant_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rapport PDF -->
                    <div class="space-y-2">
                        <label for="rapport" class="block text-sm font-medium text-gray-700">
                            Rapport de stage (PDF) <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <div class="flex text-sm text-gray-600">
                                    <label for="rapport" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none">
                                        <span>Téléverser un fichier</span>
                                        <input id="rapport" name="rapport" type="file" accept="application/pdf" class="sr-only">
                                    </label>
                                    <p class="pl-1">ou glisser-déposer</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF uniquement (max. 5MB)</p>
                            </div>
                        </div>
                        @error('rapport')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('etudiant.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-arrow-left mr-2"></i> Annuler
                        </a>
                        <button type="submit" class="btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-save mr-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </main>

    </div>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .form-input {
            transition: all 0.3s ease;
        }
        .form-input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>