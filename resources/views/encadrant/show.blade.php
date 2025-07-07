<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section with Glassmorphism Effect -->
            <div class="text-center mb-12">
                <div class="relative inline-block mb-6">
                    <div class="absolute -inset-3 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full blur opacity-20"></div>
                    <div class="relative inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Profil Encadrant</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Gérez vos informations personnelles et professionnelles</p>
            </div>

            <!-- Main Profile Card with Floating Effect -->
            <div class="relative group mb-10">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <!-- Card Header with Gradient -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                        <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                            <div class="relative">
                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border-2 border-white/30">
                                    <span class="text-2xl font-bold text-white">
                                        {{ substr($encadrant->user->name ?? 'E', 0, 1) }}
                                    </span>
                                </div>
                                <div class="absolute -bottom-2 -right-2 bg-green-400 rounded-full p-1 border-2 border-white">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center sm:text-left">
                                <h2 class="text-2xl font-bold text-white">{{ $encadrant->user->name ?? 'Encadrant' }}</h2>
                                <p class="text-indigo-100">{{ $encadrant->specialite }}</p>
                                <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white">
                                        Encadrant
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white">
                                        {{ $encadrant->etudiants->count() }} Étudiants
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body with Animated Tiles -->
                    <div class="p-6 sm:p-8">
                        <div class="grid md:grid-cols-2 gap-5">
                            
                            <!-- User Info Tile -->
                            <div class="group relative overflow-hidden rounded-xl bg-gray-50 p-5 transition-all duration-300 hover:bg-indigo-50 hover:shadow-md">
                                <div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-indigo-100 opacity-10 group-hover:opacity-20 transition duration-500"></div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-lg text-indigo-600 group-hover:bg-indigo-200 transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-500 mb-1">Nom utilisateur</h3>
                                        <p class="text-lg font-semibold text-gray-900">{{ $encadrant->user->name ?? 'Non lié' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Tile -->
                            <div class="group relative overflow-hidden rounded-xl bg-gray-50 p-5 transition-all duration-300 hover:bg-green-50 hover:shadow-md">
                                <div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-green-100 opacity-10 group-hover:opacity-20 transition duration-500"></div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg text-green-600 group-hover:bg-green-200 transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-500 mb-1">Email</h3>
                                        <p class="text-lg font-semibold text-gray-900">{{ $encadrant->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone Tile -->
                            <div class="group relative overflow-hidden rounded-xl bg-gray-50 p-5 transition-all duration-300 hover:bg-blue-50 hover:shadow-md">
                                <div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-blue-100 opacity-10 group-hover:opacity-20 transition duration-500"></div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg text-blue-600 group-hover:bg-blue-200 transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-500 mb-1">Téléphone</h3>
                                        <p class="text-lg font-semibold text-gray-900">{{ $encadrant->telephone }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Speciality Tile -->
                            <div class="group relative overflow-hidden rounded-xl bg-gray-50 p-5 transition-all duration-300 hover:bg-purple-50 hover:shadow-md">
                                <div class="absolute -right-4 -top-4 h-16 w-16 rounded-full bg-purple-100 opacity-10 group-hover:opacity-20 transition duration-500"></div>
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 p-3 bg-purple-100 rounded-lg text-purple-600 group-hover:bg-purple-200 transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-500 mb-1">Spécialité</h3>
                                        <p class="text-lg font-semibold text-gray-900">{{ $encadrant->specialite }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Cards Section -->
            <div class="grid md:grid-cols-2 gap-6 mb-10">
                <!-- Edit Profile Card -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-500"></div>
                    <a href="{{ route('encadrant.edit', $encadrant->id) }}" class="relative h-full flex items-center justify-between p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-yellow-100 rounded-lg text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Modifier le profil</h3>
                                <p class="text-gray-600">Mettre à jour vos informations</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- View Students Card -->
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-500"></div>
                    <a href="{{ route('encadrant.dashboard') }}" class="relative h-full flex items-center justify-between p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Voir mes étudiants</h3>
                                <p class="text-gray-600">Gérer les étudiants assignés</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

           

        </div>
    </div>

    <style>
        /* Custom animations */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .group:hover .group-hover\:float {
            animation: float 2s ease-in-out infinite;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Hover effects */
        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Gradient text for future use */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
    </style>
</x-app-layout>