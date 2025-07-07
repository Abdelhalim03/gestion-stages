<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Étudiant | Plateforme de Stages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .profile-card {
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .info-item {
            transition: all 0.2s ease;
        }
        .info-item:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-full">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-graduation-cap text-2xl text-primary-600 mr-2"></i>
                            <span class="text-xl font-bold text-gray-900">Stage<span class="text-primary-600">Pro</span></span>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                        <div class="ml-3 relative">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-700">John Doe</span>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=128&h=128&q=80" alt="Profil">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden profile-card">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-primary-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white">
                                <i class="fas fa-user-graduate mr-2"></i> Profil de l'Étudiant
                            </h2>
                            <p class="text-primary-100 mt-1">{{ $etudiant->filiere }} - {{ $etudiant->niveau }}</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="text-white hover:text-gray-200 text-sm font-medium flex items-center">
                                <i class="fas fa-edit mr-1"></i> Modifier
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile Body -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-info-circle text-primary-600 mr-2"></i> Informations Personnelles
                            </h3>
                            <div class="space-y-4">
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Filière</p>
                                    <p class="font-medium">{{ $etudiant->filiere }}</p>
                                </div>
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Niveau</p>
                                    <p class="font-medium">{{ $etudiant->niveau }}</p>
                                </div>
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Téléphone</p>
                                    <p class="font-medium">{{ $etudiant->telephone }}</p>
                                </div>
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $etudiant->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-university text-primary-600 mr-2"></i> Informations Académiques
                            </h3>
                            <div class="space-y-4">
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Établissement</p>
                                    <p class="font-medium">{{ $etudiant->etablissement }}</p>
                                </div>
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Encadrant</p>
                                    <p class="font-medium">{{ $etudiant->encadrant->user->name ?? 'Non assigné' }}</p>
                                </div>
                                
                                <!-- Rapport Section -->
                                @if ($etudiant->rapport)
                                <div class="info-item p-3 rounded-lg">
                                    <p class="text-sm text-gray-500">Rapport de stage</p>
                                    <div class="flex space-x-3 mt-2">
                                        <a href="{{ url('rapports/' . $etudiant->rapport) }}" target="_blank"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <i class="fas fa-eye mr-2"></i> Voir
                                        </a>
                                        <a href="{{ url('rapports/' . $etudiant->rapport) }}" download
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <i class="fas fa-download mr-2"></i> Télécharger
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="p-3 rounded-lg bg-yellow-50 text-yellow-700">
                                    <i class="fas fa-exclamation-circle mr-2"></i> Aucun rapport déposé
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap justify-between items-center">
                        <a href="{{ url()->previous() }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </a>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="fas fa-edit mr-2"></i> Modifier le profil
                            </a>
                            
                            <form action="{{ route('etudiants.destroy') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce profil ? Cette action est irréversible.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex justify-center md:order-2 space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <div class="mt-8 md:mt-0 md:order-1">
                        <p class="text-center text-sm text-gray-500">
                            &copy; 2023 Plateforme de Gestion des Stages. Tous droits réservés.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>