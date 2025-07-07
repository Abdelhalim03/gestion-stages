<x-app-layout>
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
                    },
                    accent: {
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
                    }
                },
                fontFamily: {
                    sans: ['Inter', 'system-ui', 'sans-serif'],
                    display: ['Inter', 'system-ui', 'sans-serif'],
                },
                animation: {
                    'fade-in': 'fadeIn 0.6s ease-out',
                    'slide-up': 'slideUp 0.5s ease-out',
                    'scale-in': 'scaleIn 0.4s ease-out',
                    'progress': 'progress 2s ease-out',
                },
                keyframes: {
                    fadeIn: {
                        '0%': { opacity: '0', transform: 'translateY(10px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    slideUp: {
                        '0%': { opacity: '0', transform: 'translateY(20px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' }
                    },
                    scaleIn: {
                        '0%': { opacity: '0', transform: 'scale(0.95)' },
                        '100%': { opacity: '1', transform: 'scale(1)' }
                    },
                    progress: {
                        '0%': { width: '0%' },
                        '100%': { width: 'var(--progress-width)' }
                    }
                },
                boxShadow: {
                    'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                    'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                    'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15)',
                }
            }
        }
    }
</script>

<style>
    /* Improved card design with better hierarchy */
    .card-professional {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
    }
    
    .card-professional:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        border-color: rgba(14, 165, 233, 0.3);
    }
    
    /* Smoother progress bar */
    .progress-bar {
        background: linear-gradient(90deg, #0ea5e9, #3b82f6);
        animation: progress 1.5s ease-out forwards;
        height: 6px;
        border-radius: 3px;
    }
    
    /* Subtler status indicator */
    .status-indicator {
        position: relative;
    }
    
    .status-indicator::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: inherit;
        transform: translate(-50%, -50%);
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        opacity: 0.6;
    }
    
    /* Enhanced metric cards */
    .metric-card {
        background: white;
        border-left: 4px solid;
        transition: all 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
    }
    
    .metric-card:hover {
        transform: translateX(2px);
        box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.08);
    }
    
    /* More refined action buttons */
    .action-button {
        background: white;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }
    
    .action-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(14, 165, 233, 0.05), transparent);
        transition: left 0.6s ease;
    }
    
    .action-button:hover::before {
        left: 100%;
    }
    
    .action-button:hover {
        border-color: #bae6fd;
        box-shadow: 0 4px 12px -2px rgba(14, 165, 233, 0.15);
        transform: translateY(-2px);
    }
    
    /* Subtler glass effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    /* Better typography hierarchy */
    .text-display {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .text-heading {
        font-size: 1.5rem;
        font-weight: 600;
        line-height: 1.3;
    }
    
    .text-subheading {
        font-size: 1.125rem;
        font-weight: 500;
        line-height: 1.4;
        color: #64748b;
    }
    
    /* Improved form controls */
    .form-input {
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
    }
    
    .form-input:focus {
        border-color: #7dd3fc;
        box-shadow: 0 0 0 3px rgba(125, 211, 252, 0.3);
        outline: none;
    }
    
    /* Better spacing system */
    .space-y-8 > * + * {
        margin-top: 2rem;
    }
    
    /* Enhanced data visualization */
    .data-visualization {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.03);
    }
    
    /* Responsive improvements */
    @media (max-width: 768px) {
        .text-display {
            font-size: 1.75rem;
        }
        
        .text-heading {
            font-size: 1.25rem;
        }
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/20 to-indigo-50/30">
    
    <!-- Enhanced Header Section -->
    <div class="bg-white border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center space-x-5">
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white status-indicator"></div>
                    </div>
                    <div>
                        <h1 class="text-display text-gray-900 mb-1">
                            Bonjour, {{ Auth::user()->name }}
                        </h1>
                        <p class="text-subheading">Tableau de bord étudiant</p>
                        <div class="flex items-center mt-3 space-x-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h8m-8 0H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                                </svg>
                                Dernière connexion: {{ now()->format('d/m/Y à H:i') }}
                            </span>
                            <span class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                En ligne
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 lg:mt-0 flex items-center space-x-4">
                    <div class="glass-effect rounded-lg px-5 py-2">
                        <div class="text-center">
                            <div class="text-xl font-semibold text-primary-600">{{ date('d') }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">{{ date('M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Quick Stats Row - Improved layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <!-- Profile Completion -->
            <div class="metric-card rounded-xl p-5 border-l-primary-500 animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Profil complété</p>
                        @php
                            $profileFields = [
                                'name' => Auth::user()->name,
                                'email' => Auth::user()->email,
                                'entreprise' => Auth::user()->etudiant?->entreprise,
                                'duree' => Auth::user()->etudiant?->duree,
                                'sujet' => Auth::user()->etudiant?->sujet,
                            ];
                            $completedFields = array_filter($profileFields, fn($field) => !empty($field));
                            $profileCompletion = round((count($completedFields) / count($profileFields)) * 100);
                        @endphp
                        <p class="text-2xl font-bold text-gray-900">{{ $profileCompletion }}%</p>
                    </div>
                    <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="bg-gray-100 rounded-full h-1.5">
                        <div class="progress-bar h-1.5 rounded-full" style="--progress-width: {{ $profileCompletion }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Stage Status -->
            <div class="metric-card rounded-xl p-5 border-l-orange-500 animate-fade-in" style="animation-delay: 0.1s;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Statut de stage</p>
                        @if(Auth::user()->etudiant && Auth::user()->etudiant->statut_rapport)
                            <p class="text-xl font-bold text-gray-900">{{ ucfirst(str_replace('_', ' ', Auth::user()->etudiant->statut_rapport)) }}</p>
                        @else
                            <p class="text-xl font-bold text-gray-900">Non défini</p>
                        @endif
                    </div>
                    <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-orange-600 mt-2 truncate">
                    {{ Auth::user()->etudiant?->entreprise ?? 'Entreprise non définie' }}
                </p>
            </div>

            <!-- PFE Status -->
            <div class="metric-card rounded-xl p-5 border-l-purple-500 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Statut PFE</p>
                        @if(Auth::user()->etudiant && Auth::user()->etudiant->rapport_pfe)
                            <p class="text-xl font-bold text-gray-900">Soumis</p>
                        @else
                            <p class="text-xl font-bold text-gray-900">En cours</p>
                        @endif
                    </div>
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-purple-600 mt-2 truncate">
                    {{ Auth::user()->etudiant?->titre_pfe ? Str::limit(Auth::user()->etudiant->titre_pfe, 25) : 'Titre non défini' }}
                </p>
            </div>
        </div>

        <!-- Main Dashboard Grid - Improved structure -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- Left Column - Main Content -->
            <div class="lg:col-span-3 space-y-6">
                
                <!-- Profile Management - Enhanced card -->
                <div class="card-professional rounded-xl p-6 animate-slide-up">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-heading text-gray-900 mb-1">Gestion du Profil</h3>
                                <p class="text-sm text-gray-500">Mettez à jour vos informations personnelles et académiques</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="text-right mr-4">
                                <div class="text-xl font-bold text-primary-600">{{ $profileCompletion }}%</div>
                                <div class="text-xs text-gray-500">Complété</div>
                            </div>
                            <div class="w-10 h-10 bg-primary-50 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('etudiants.create') }}" class="action-button rounded-lg p-5 block group">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <h4 class="text-base font-semibold text-gray-900 mb-1">
                                {{ Auth::user()->etudiant ? 'Modifier le profil' : 'Créer le profil' }}
                            </h4>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->etudiant ? 'Mettez à jour vos informations' : 'Ajoutez vos informations personnelles et académiques' }}
                            </p>
                        </a>

                        @if(Auth::user()->etudiant)
                        <a href="{{ route('etudiants.show') }}" class="action-button rounded-lg p-5 block group">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <h4 class="text-base font-semibold text-gray-900 mb-1">Consulter le profil</h4>
                            <p class="text-xs text-gray-500">Visualisez vos informations enregistrées</p>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Academic Modules - Improved layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Stage Module -->
                    <div class="card-professional rounded-xl p-5 animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Stage</h3>
                                    <p class="text-xs text-gray-500">Suivi de stage</p>
                                </div>
                            </div>
                            @if(Auth::user()->etudiant && Auth::user()->etudiant->statut_rapport)
                                @php
                                    $statutColor = [
                                        'valide' => 'green',
                                        'refuse' => 'red',
                                        'en_attente' => 'yellow'
                                    ][Auth::user()->etudiant->statut_rapport] ?? 'gray';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $statutColor }}-100 text-{{ $statutColor }}-800 border border-{{ $statutColor }}-200">
                                    {{ ucfirst(str_replace('_', ' ', Auth::user()->etudiant->statut_rapport)) }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    Non défini
                                </span>
                            @endif
                        </div>
                        
                        <div class="space-y-3 mb-5">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium text-gray-500">Entreprise:</span>
                                <span class="text-xs font-medium text-gray-900 truncate max-w-[120px]">
                                    {{ Auth::user()->etudiant?->entreprise ?? 'Non définie' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium text-gray-500">Durée:</span>
                                <span class="text-xs font-medium text-gray-900">{{ Auth::user()->etudiant?->duree ?? 'Non définie' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium text-gray-500">Sujet:</span>
                                <span class="text-xs font-medium text-gray-900 truncate max-w-[120px]">
                                    {{ Auth::user()->etudiant?->sujet ?? 'Non défini' }}
                                </span>
                            </div>
                        </div>
                        
                        <a href="{{ route('etudiant.stage.indexstage') }}" class="action-button w-full py-2.5 px-4 rounded-lg text-sm font-medium text-center flex items-center justify-center group">
                            Gérer le stage
                            <svg class="w-3.5 h-3.5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- PFE Module -->
                    <div class="card-professional rounded-xl p-5 animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">PFE</h3>
                                    <p class="text-xs text-gray-500">Projet de fin d'études</p>
                                </div>
                            </div>
                            @if(Auth::user()->etudiant && Auth::user()->etudiant->rapport_pfe)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    Soumis
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                    En cours
                                </span>
                            @endif
                        </div>
                        
                        <div class="space-y-3 mb-5">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium text-gray-500">Titre:</span>
                                <span class="text-xs font-medium text-gray-900 truncate max-w-[120px]">
                                    {{ Auth::user()->etudiant?->titre_pfe ?? 'Non défini' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-medium text-gray-500">Durée:</span>
                                <span class="text-xs font-medium text-gray-900">{{ Auth::user()->etudiant?->duree_pfe ?? 'Non définie' }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('etudiant.pfe.indexpfe') }}" class="action-button w-full py-2.5 px-4 rounded-lg text-sm font-medium text-center flex items-center justify-center group">
                            Gérer le PFE
                            <svg class="w-3.5 h-3.5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Documents Section - More refined -->
                <div class="card-professional rounded-xl p-6 animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-heading text-gray-900 mb-1">Documents</h3>
                                <p class="text-sm text-gray-500">Gérez vos rapports et fichiers académiques</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('etudiants.documents') }}" class="action-button w-full py-3 px-5 rounded-lg text-sm font-medium text-center flex items-center justify-center group">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v0"></path>
                        </svg>
                        Accéder à mes documents
                        <svg class="w-3.5 h-3.5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Sidebar - Quick Actions -->
            <div class="space-y-5">
                
                <!-- Quick Actions - More compact -->
                <div class="card-professional rounded-xl p-5 animate-scale-in" style="animation-delay: 0.4s;">
                    <div class="flex items-center mb-5">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Actions Rapides</h3>
                            <p class="text-xs text-gray-500">Accès direct</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        @if(Auth::user()->etudiant && Auth::user()->etudiant->encadrant)
                        <a href="{{ route('etudiant.chat') }}" class="action-button w-full p-3 rounded-lg flex items-center group">
                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mr-2 group-hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-gray-900">Contacter encadrant</div>
                            </div>
                        </a>
                        @endif
                        
                        <button class="action-button w-full p-3 rounded-lg flex items-center group">
                            <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center mr-2 group-hover:bg-green-100 transition-colors">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-gray-900">Centre d'aide</div>
                                <div class="text-xs text-gray-500">Support et FAQ</div>
                            </div>
                        </button>
                        
                        <button class="action-button w-full p-3 rounded-lg flex items-center group">
                            <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center mr-2 group-hover:bg-purple-100 transition-colors">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-gray-900">Téléchargements</div>
                                <div class="text-xs text-gray-500">Modèles et formulaires</div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Status Summary - More organized -->
                <div class="card-professional rounded-xl p-5 animate-scale-in" style="animation-delay: 0.5s;">
                    <div class="flex items-center mb-5">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Résumé</h3>
                            <p class="text-xs text-gray-500">État général</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-primary-500 rounded-full mr-2"></div>
                                <span class="text-xs font-medium text-gray-700">Profil</span>
                            </div>
                            <span class="text-xs font-bold text-primary-600">{{ $profileCompletion }}%</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                                <span class="text-xs font-medium text-gray-700">Stage</span>
                            </div>
                            <span class="text-xs font-bold text-orange-600">
                                @if(Auth::user()->etudiant && Auth::user()->etudiant->statut_rapport === 'valide')
                                    Validé
                                @elseif(Auth::user()->etudiant && Auth::user()->etudiant->statut_rapport === 'en_attente')
                                    En attente
                                @else
                                    À faire
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                                <span class="text-xs font-medium text-gray-700">PFE</span>
                            </div>
                            <span class="text-xs font-bold text-purple-600">
                                @if(Auth::user()->etudiant && Auth::user()->etudiant->rapport_pfe)
                                    Soumis
                                @else
                                    En cours
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Progress bars animation
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.getPropertyValue('--progress-width');
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 300);
        });

        // Enhanced card hover effects
        const cards = document.querySelectorAll('.card-professional');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.08)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.03)';
            });
        });

        // Improved action buttons with ripple effect
        const actionButtons = document.querySelectorAll('.action-button');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Remove any existing ripple
                const existingRipple = this.querySelector('.ripple-effect');
                if (existingRipple) {
                    existingRipple.remove();
                }
                
                const ripple = document.createElement('div');
                ripple.className = 'ripple-effect';
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(14, 165, 233, 0.2);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
            
            /* Tooltip styles */
            [data-tooltip] {
                position: relative;
            }
            
            [data-tooltip]:hover::after {
                content: attr(data-tooltip);
                position: absolute;
                bottom: 100%;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0,0,0,0.75);
                color: white;
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                font-size: 0.75rem;
                white-space: nowrap;
                z-index: 10;
                margin-bottom: 0.5rem;
            }
        `;
        document.head.appendChild(style);
        
        // Add tooltips to truncated text
        document.querySelectorAll('.truncate').forEach(element => {
            if (element.offsetWidth < element.scrollWidth) {
                element.setAttribute('data-tooltip', element.textContent);
            }
        });
    });
</script>
</x-app-layout>