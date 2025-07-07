<x-app-layout>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                },
                accent: {
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
                'sans': ['Inter', 'system-ui', 'sans-serif'],
            },
            boxShadow: {
                'soft': '0 1px 3px rgba(0,0,0,0.05)',
                'card': '0 2px 6px rgba(0,0,0,0.08)',
                'elevated': '0 4px 12px rgba(0,0,0,0.1)',
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease-out',
                'slide-up': 'slideUp 0.4s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' }
                },
                slideUp: {
                    '0%': { transform: 'translateY(10px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' }
                }
            }
        }
    }
}
</script>

<style>
.professional-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    transition: all 0.2s ease;
}

.professional-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.status-indicator {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-validated { background-color: #dcfce7; color: #166534; }
.status-pending { background-color: #fef3c7; color: #92400e; }
.status-rejected { background-color: #fee2e2; color: #991b1b; }
.status-not-submitted { background-color: #f3f4f6; color: #374151; }

.section-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 1.25rem 1.5rem;
}

.document-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    padding: 1rem;
    transition: all 0.2s ease;
}

.document-item:hover {
    background: #f1f5f9;
    border-color: #0ea5e9;
    transform: translateY(-2px);
}

.progress-indicator {
    width: 100%;
    height: 0.5rem;
    background-color: #e2e8f0;
    border-radius: 0.25rem;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #0ea5e9, #0284c7);
    transition: width 0.6s ease;
}

.upload-area {
    border: 2px dashed #cbd5e1;
    border-radius: 0.75rem;
    transition: all 0.2s ease;
}

.upload-area:hover {
    border-color: #0ea5e9;
    background-color: #f0f9ff;
}

.btn-primary {
    background-color: #0ea5e9;
    color: white;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background-color: #0284c7;
    transform: translateY(-1px);
}

.btn-secondary {
    background-color: #f1f5f9;
    color: #334155;
    transition: all 0.2s ease;
}

.btn-secondary:hover {
    background-color: #e2e8f0;
    transform: translateY(-1px);
}

.hover-scale {
    transition: transform 0.2s ease;
}

.hover-scale:hover {
    transform: scale(1.02);
}
</style>

<div class="min-h-screen bg-gray-50">
    
    <!-- Professional Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-accent-500 rounded-lg flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Tableau de Bord Étudiant</h1>
                        <p class="text-sm text-gray-600">Gestion de votre stage professionnel</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Connecté en tant que</p>
                        <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="relative">
                        <div class="w-10 h-10 bg-accent-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Success Alert -->
        @if (session('success'))
        <div class="mb-8 professional-card rounded-lg p-4 bg-green-50 border border-green-200 animate-fade-in">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Main Layout: Principal Content + Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Principal Content (Left - 2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Student Information -->
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informations Étudiant
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Nom Complet</p>
                                <p class="text-base font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Email</p>
                                <p class="text-base font-medium text-gray-900">{{ $etudiant->email }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Filière</p>
                                <p class="text-base font-medium text-gray-900">{{ $etudiant->filiere }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Niveau</p>
                                <p class="text-base font-medium text-gray-900">{{ $etudiant->niveau }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Information -->
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Projet de Stage
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="bg-accent-50 border border-accent-200 rounded-lg p-4 mb-6">
                            <p class="text-xs font-medium text-accent-700 uppercase tracking-wide mb-2">Sujet du Stage</p>
                            <p class="text-lg text-accent-900 font-medium">{{ $etudiant->sujet ?? 'Non défini' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            @if ($etudiant->rapport)
                            <a href="{{ asset('rapports/' . $etudiant->rapport) }}" target="_blank" 
                               class="document-item text-center group">
                                <svg class="w-8 h-8 mx-auto mb-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 group-hover:text-accent-600">Voir le Rapport</p>
                            </a>
                            @endif
                            
                            @if ($etudiant->presentation)
                            <a href="{{ asset('presentations/' . $etudiant->presentation) }}" target="_blank" 
                               class="document-item text-center group">
                                <svg class="w-8 h-8 mx-auto mb-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z"></path>
                                </svg>
                                <p class="text-sm font-medium text-gray-900 group-hover:text-accent-600">Voir la Présentation</p>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Document Upload Forms -->
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Dépôt de Documents
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        
                        <!-- Report Upload -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Rapport de Stage</h3>
                            <form method="POST" action="{{ route('etudiant.stage.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="upload-area p-6 text-center cursor-pointer">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <label for="rapport" class="cursor-pointer">
                                        <span class="text-accent-600 font-medium hover:text-accent-500">Sélectionner un fichier PDF</span>
                                        <input id="rapport" name="rapport" type="file" accept="application/pdf" class="sr-only">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2">PDF jusqu'à 10MB</p>
                                </div>
                                @error('rapport')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <button type="submit" class="btn-primary w-full mt-4 py-3 px-4 rounded-lg font-medium">
                                    Déposer le Rapport
                                </button>
                            </form>
                        </div>

                        <!-- Presentation Upload -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Présentation de Soutenance</h3>
                            <form method="POST" action="{{ route('etudiant.presentation.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="upload-area p-6 text-center cursor-pointer">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z"></path>
                                    </svg>
                                    <label for="presentation" class="cursor-pointer">
                                        <span class="text-accent-600 font-medium hover:text-accent-500">Sélectionner un fichier PPT/PDF</span>
                                        <input id="presentation" name="presentation" type="file" accept=".ppt,.pptx,.pdf" class="sr-only">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2">PPT/PDF jusqu'à 20MB</p>
                                </div>
                                @error('presentation')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <button type="submit" class="btn-primary w-full mt-4 py-3 px-4 rounded-lg font-medium bg-purple-600 hover:bg-purple-700">
                                    Déposer la Présentation
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                @if ($etudiant->commentaire_rapport || $etudiant->commentaire_presentation)
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Commentaires de l'Encadrant
                        </h2>
                    </div>
                    <div class="p-6 space-y-4">
                        @if ($etudiant->commentaire_rapport)
                        <div>
                            <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Commentaire sur le Rapport</h4>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <p class="text-blue-900">{{ $etudiant->commentaire_rapport }}</p>
                            </div>
                        </div>
                        @endif

                        @if ($etudiant->commentaire_presentation)
                        <div>
                            <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Commentaire sur la Présentation</h4>
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                <p class="text-purple-900">{{ $etudiant->commentaire_presentation }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('etudiant.stage.edit') }}" 
                       class="professional-card p-6 block hover-scale">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Modifier les Informations</h3>
                                    <p class="text-sm text-gray-600">Compléter ou modifier les détails du stage</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('etudiant.historique_commentaires') }}" 
                       class="professional-card p-6 block hover-scale">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Historique Complet</h3>
                                    <p class="text-sm text-gray-600">Voir l'historique des commentaires</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Sidebar (Right - 1/3 width) -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Supervisor Information -->
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Encadrant Pédagogique
                        </h2>
                    </div>
                    <div class="p-4">
                        @if ($encadrant)
                            <div class="space-y-3 mb-4">
                                <div class="p-2 bg-gray-50 rounded-lg">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Email</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $encadrant->email }}</p>
                                </div>
                                <div class="p-2 bg-gray-50 rounded-lg">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Téléphone</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $encadrant->telephone ?? 'Non renseigné' }}</p>
                                </div>
                                <div class="p-2 bg-gray-50 rounded-lg">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Spécialité</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $encadrant->specialite ?? 'Non renseignée' }}</p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('etudiant.chat') }}" 
                                   class="btn-primary w-full py-2 px-3 rounded-lg text-sm font-medium flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    Contacter
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <h3 class="text-sm font-medium text-gray-900 mb-2">Aucun Encadrant</h3>
                                <p class="text-xs text-gray-600 mb-3">Contacter l'administration</p>
                                <a href="{{ route('etudiant.stage.edit') }}" 
                                   class="btn-secondary inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium">
                                    Compléter
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Important Dates Section -->
                @if ($etudiant && $etudiant->encadrant)
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-8 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                            </svg>
                            Échéances importantes
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Rapport</p>
                                    <p class="text-sm font-bold text-gray-900">
                                        {{ $etudiant->encadrant->date_limite_rapport 
                                            ? \Carbon\Carbon::parse($etudiant->encadrant->date_limite_rapport)->format('d/m/Y') 
                                            : 'Non définie' 
                                        }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-100">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Soutenance</p>
                                    <p class="text-sm font-bold text-gray-900">
                                        {{ $etudiant->encadrant->date_soutenance 
                                            ? \Carbon\Carbon::parse($etudiant->encadrant->date_soutenance)->format('d/m/Y') 
                                            : 'Non définie' 
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Document Status Overview -->
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            État d'avancement
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4 mb-6">
                            <!-- Rapport Status -->
                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full flex items-center justify-center
                                    {{ $etudiant->statut_rapport == 'valide' ? 'bg-green-100' : 
                                       ($etudiant->statut_rapport == 'refuse' ? 'bg-red-100' : 'bg-yellow-100') }}">
                                    @if ($etudiant->statut_rapport == 'valide')
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif ($etudiant->statut_rapport == 'refuse')
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">Rapport</h3>
                                @if ($etudiant->statut_rapport)
                                    <span class="status-indicator 
                                        {{ $etudiant->statut_rapport == 'valide' ? 'status-validated' : 
                                           ($etudiant->statut_rapport == 'refuse' ? 'status-rejected' : 'status-pending') }}">
                                        {{ $etudiant->statut_rapport == 'valide' ? 'Validé' : 
                                           ($etudiant->statut_rapport == 'refuse' ? 'Refusé' : 'En attente') }}
                                    </span>
                                @else
                                    <span class="status-indicator status-not-submitted">Non soumis</span>
                                @endif
                            </div>

                            <!-- Presentation Status -->
                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full flex items-center justify-center
                                    {{ $etudiant->statut_presentation == 'valide' ? 'bg-green-100' : 
                                       ($etudiant->statut_presentation == 'refuse' ? 'bg-red-100' : 'bg-yellow-100') }}">
                                    @if ($etudiant->statut_presentation == 'valide')
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif ($etudiant->statut_presentation == 'refuse')
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">Présentation</h3>
                                @if ($etudiant->statut_presentation)
                                    <span class="status-indicator 
                                        {{ $etudiant->statut_presentation == 'valide' ? 'status-validated' : 
                                           ($etudiant->statut_presentation == 'refuse' ? 'status-rejected' : 'status-pending') }}">
                                        {{ $etudiant->statut_presentation == 'valide' ? 'Validé' : 
                                           ($etudiant->statut_presentation == 'refuse' ? 'Refusé' : 'En attente') }}
                                    </span>
                                @else
                                    <span class="status-indicator status-not-submitted">Non soumis</span>
                                @endif
                            </div>

                            <!-- Admin Validation -->
                            <div class="text-center p-3 bg-white rounded-lg border border-gray-100">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full flex items-center justify-center
                                    {{ $etudiant->validation_admin === 'validé' ? 'bg-green-100' : 
                                       ($etudiant->validation_admin === 'refusé' ? 'bg-red-100' : 'bg-yellow-100') }}">
                                    @if($etudiant->validation_admin === 'validé')
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif($etudiant->validation_admin === 'refusé')
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">Admin</h3>
                                @if($etudiant->validation_admin === 'validé')
                                    <span class="status-indicator status-validated">Validé</span>
                                @elseif($etudiant->validation_admin === 'refusé')
                                    <span class="status-indicator status-rejected">Refusé</span>
                                @else
                                    <span class="status-indicator status-pending">En attente</span>
                                @endif
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-medium text-gray-700">Progression</span>
                                @php
                                    $progress = 0;
                                    if ($etudiant->rapport) $progress += 25;
                                    if ($etudiant->presentation) $progress += 25;
                                    if ($etudiant->statut_rapport == 'valide') $progress += 25;
                                    if ($etudiant->statut_presentation == 'valide') $progress += 25;
                                @endphp
                                <span class="text-xs font-bold text-accent-600">{{ $progress }}%</span>
                            </div>
                            <div class="progress-indicator">
                                <div class="progress-bar" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- History Section -->
                @if($etudiant->modificationHistories->count())
                <div class="professional-card animate-slide-up">
                    <div class="section-header">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Historique
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            @foreach($etudiant->modificationHistories->take(3) as $history)
                            <div class="flex items-start space-x-2 pb-3 border-b border-gray-100 last:border-b-0">
                                <div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    @if($history->type === 'rapport')
                                        <svg class="w-3 h-3 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs font-medium text-gray-900">
                                        {{ ucfirst($history->type) }} : {{ $history->nouveau_statut }}
                                    </p>
                                    <time class="text-xs text-gray-500">{{ $history->created_at->format('d/m/Y') }}</time>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>
</div>

<!-- Modal for Status Details -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full animate-fade-in">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Détail du Statut</h3>
                <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="px-6 py-4">
            <div id="statusModalContent"></div>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 text-right">
            <button onclick="closeStatusModal()" class="btn-primary py-2 px-4 rounded-lg font-medium">
                Fermer
            </button>
        </div>
    </div>
</div>

<script>
function showStatusModal(type) {
    let content = '';
    let statut = '';
    let commentaire = '';

    if (type === 'rapport') {
        statut = '{{ $etudiant->statut_rapport }}';
        commentaire = '{{ $etudiant->commentaire_rapport }}';
    } else {
        statut = '{{ $etudiant->statut_presentation }}';
        commentaire = '{{ $etudiant->commentaire_presentation }}';
    }

    if (statut === 'valide') {
        content = `<div class="text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-green-800 mb-2">Document Validé</h4>
            <p class="text-green-700 mb-4">Votre ${type} a été validé par votre encadrant.</p>
            ${commentaire ? `<div class="bg-green-50 border border-green-200 rounded-lg p-3 text-left"><p class="text-sm text-green-800"><strong>Commentaire :</strong> ${commentaire}</p></div>` : ''}
        </div>`;
    } else if (statut === 'refuse') {
        content = `<div class="text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-red-800 mb-2">Document Refusé</h4>
            <p class="text-red-700 mb-4">Votre ${type} nécessite des corrections.</p>
            ${commentaire ? `<div class="bg-red-50 border border-red-200 rounded-lg p-3 text-left"><p class="text-sm text-red-800"><strong>Commentaire :</strong> ${commentaire}</p></div>` : ''}
        </div>`;
    } else {
        content = `<div class="text-center">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-yellow-800 mb-2">En Attente</h4>
            <p class="text-yellow-700">Votre ${type} est en cours d'évaluation.</p>
        </div>`;
    }

    document.getElementById('statusModalContent').innerHTML = content;
    document.getElementById('statusModal').classList.remove('hidden');
    document.getElementById('statusModal').classList.add('flex');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
    document.getElementById('statusModal').classList.remove('flex');
}

// Add click handlers to status indicators
document.addEventListener('DOMContentLoaded', function() {
    // Add click events to status circles for modal display
    const statusCircles = document.querySelectorAll('[data-status-type]');
    statusCircles.forEach(circle => {
        circle.addEventListener('click', function() {
            const type = this.getAttribute('data-status-type');
            showStatusModal(type);
        });
        circle.style.cursor = 'pointer';
    });
    
    // Animate progress bar on page load
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        const width = progressBar.style.width;
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.width = width;
        }, 300);
    }
});
</script>

</x-app-layout>