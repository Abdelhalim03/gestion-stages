<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Header section amélioré -->
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                                Conversations avec vos étudiants
                            </h1>
                        </div>
                        <p class="text-gray-600 text-lg">Gérez les échanges avec vos étudiants encadrés en temps réel</p>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="hidden md:flex items-center gap-2 text-sm text-green-600 bg-green-50 px-4 py-2 rounded-full border border-green-200">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="font-medium">Mise à jour en temps réel</span>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>

            <!-- Stats cards améliorées -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1 group-hover:text-gray-600">Conversations actives</p>
                            <p class="text-3xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">{{ $conversations->count() }}</p>
                            <p class="text-xs text-green-600 mt-1">+2 cette semaine</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl flex items-center justify-center group-hover:from-indigo-500 group-hover:to-indigo-600 transition-all duration-300">
                            <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1 group-hover:text-gray-600">Nouveaux messages</p>
                            <p class="text-3xl font-bold text-blue-600 group-hover:text-blue-700 transition-colors duration-200">
                                {{ $conversations->sum(function($conv) { return $conv->unread_messages ?? 0; }) }}
                            </p>
                            <p class="text-xs text-blue-600 mt-1">Dernière heure</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center group-hover:from-blue-500 group-hover:to-blue-600 transition-all duration-300">
                            <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:scale-105 transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1 group-hover:text-gray-600">Étudiants encadrés</p>
                            <p class="text-3xl font-bold text-green-600 group-hover:text-green-700 transition-colors duration-200">{{ $conversations->unique('etudiant_id')->count() }}</p>
                            <p class="text-xs text-green-600 mt-1">Tous actifs</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center group-hover:from-green-500 group-hover:to-green-600 transition-all duration-300">
                            <svg class="w-6 h-6 text-green-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                
            </div>

            <!-- Search and filter améliorés -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-gray-100">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="relative flex-1 max-w-md">
                        <input 
                            type="text" 
                            placeholder="Rechercher un étudiant ou un message..." 
                            class="pl-12 pr-4 py-3 w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 hover:border-gray-300"
                            id="search-input"
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <kbd class="px-2 py-1 text-xs text-gray-500 bg-gray-100 rounded border">⌘K</kbd>
                        </div>
                    </div>

                    
                </div>
            </div>

            <!-- Conversations list améliorée -->
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                @if($conversations->isEmpty())
                    <div class="text-center p-20">
                        <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
                            <svg class="h-12 w-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Aucune conversation pour le moment</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">Vos étudiants pourront vous contacter dès qu'ils auront des questions ou besoin d'aide.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                                Inviter des étudiants
                            </button>
                            <button class="px-8 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-medium">
                                Voir le guide
                            </button>
                        </div>
                    </div>
                @else
                    <div class="divide-y divide-gray-50">
                        @foreach ($conversations as $index => $conv)
                            <div class="conversation-item hover:bg-gradient-to-r hover:from-gray-50 hover:to-indigo-50 transition-all duration-300 group relative overflow-hidden" style="animation-delay: {{ $index * 0.1 }}s">
                                <!-- Indicateur de priorité -->
                                @if(isset($conv->unread_messages) && $conv->unread_messages > 3)
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-red-500 to-orange-500"></div>
                                @elseif(isset($conv->unread_messages) && $conv->unread_messages > 0)
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 to-indigo-500"></div>
                                @endif
                                
                                <a href="{{ route('encadrant.chat', $conv->id) }}" class="block p-6 pl-8">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4 flex-1">
                                            <!-- Avatar amélioré -->
                                            <div class="relative flex-shrink-0">
                                                <div class="h-16 w-16 rounded-full bg-gradient-to-br from-indigo-400 via-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                                    {{ substr($conv->etudiant->user->name ?? '?', 0, 1) }}
                                                </div>
                                                
                                                <!-- Indicateur de statut -->
                                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-3 border-white flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                                </div>
                                                
                                                <!-- Badge de messages non lus -->
                                                @if(isset($conv->unread_messages) && $conv->unread_messages > 0)
                                                    <div class="absolute -top-2 -right-2 w-7 h-7 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                                                        <span class="text-xs text-white font-bold">{{ min($conv->unread_messages, 9) }}{{ $conv->unread_messages > 9 ? '+' : '' }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Content amélioré -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center gap-3">
                                                        <h4 class="font-bold text-gray-900 text-xl group-hover:text-indigo-600 transition-colors duration-200">
                                                            {{ $conv->etudiant->user->name ?? 'Étudiant inconnu' }}
                                                        </h4>
                                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-medium">
                                                            Étudiant
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-sm text-gray-500 font-medium">
                                                            {{ $conv->updated_at->diffForHumans() }}
                                                        </span>
                                                        @if($conv->updated_at->isToday())
                                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <p class="text-gray-600 text-sm line-clamp-2 mb-3 leading-relaxed">
                                                    @if($conv->messages && $conv->messages->last())
                                                        <span class="font-semibold text-gray-800">{{ $conv->messages->last()->user->name }}:</span>
                                                        <span class="ml-1">{{ Str::limit($conv->messages->last()->contenu, 100) }}</span>
                                                    @else
                                                        <span class="italic text-gray-400">Aucun message échangé</span>
                                                    @endif
                                                </p>

                                                <!-- Tags/Status améliorés -->
                                                <div class="flex items-center gap-3">
                                                    @if(isset($conv->unread_messages) && $conv->unread_messages > 0)
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                            </svg>
                                                            {{ $conv->unread_messages }} nouveau{{ $conv->unread_messages > 1 ? 'x' : '' }}
                                                        </span>
                                                    @endif
                                                    
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                                        En ligne
                                                    </span>
                                                    
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                        </svg>
                                                        {{ $conv->messages->count() ?? 0 }} messages
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Arrow avec animation -->
                                        <div class="ml-6 flex-shrink-0 transform group-hover:translate-x-2 transition-transform duration-200">
                                            <div class="w-10 h-10 bg-gray-100 group-hover:bg-indigo-100 rounded-full flex items-center justify-center transition-colors duration-200">
                                                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Footer avec statistiques -->
            @if($conversations->isNotEmpty())
                <div class="mt-8 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div class="flex items-center gap-6 text-sm text-gray-600">
                            <span class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                {{ $conversations->count() }} conversation(s) active(s)
                            </span>
                            <span class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                {{ $conversations->sum(function($conv) { return $conv->unread_messages ?? 1; }) }} message(s) non lu(s)
                            </span>
                        </div>
                        
                       
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Animations personnalisées avancées */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .conversation-item {
            animation: fadeInUp 0.6s ease-out both;
        }
        
        /* Limitation du texte améliorée */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }
        
        /* Hover effects avancés */
        .conversation-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Bordures personnalisées */
        .border-3 {
            border-width: 3px;
        }
        
        /* Animations de chargement */
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        /* Effets de gradient */
        .bg-gradient-to-r {
            background-image: linear-gradient(to right, var(--tw-gradient-stops));
        }
        
        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #cbd5e1, #94a3b8);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #94a3b8, #64748b);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Recherche en temps réel améliorée
            const searchInput = document.getElementById('search-input');
            const conversationItems = document.querySelectorAll('.conversation-item');
            let searchTimeout;
            
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    const searchTerm = this.value.toLowerCase();
                    
                    searchTimeout = setTimeout(() => {
                        conversationItems.forEach((item, index) => {
                            const studentName = item.querySelector('h4').textContent.toLowerCase();
                            const messageContent = item.querySelector('p').textContent.toLowerCase();
                            
                            if (studentName.includes(searchTerm) || messageContent.includes(searchTerm)) {
                                item.style.display = 'block';
                                item.style.animation = `fadeInUp 0.3s ease-out ${index * 0.05}s both`;
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    }, 300);
                });
                
                // Raccourci clavier Cmd+K / Ctrl+K
                document.addEventListener('keydown', function(e) {
                    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });
            }
            
            // Menu d'actions rapides
            window.toggleQuickActions = function() {
                const menu = document.getElementById('quickActionsMenu');
                menu.classList.toggle('hidden');
            };
            
            // Fermer les menus en cliquant ailleurs
            document.addEventListener('click', function(e) {
                const quickActionsMenu = document.getElementById('quickActionsMenu');
                const quickActionsButton = e.target.closest('button[onclick="toggleQuickActions()"]');
                
                if (!quickActionsButton && !quickActionsMenu.contains(e.target)) {
                    quickActionsMenu.classList.add('hidden');
                }
            });
            
            // Animation au scroll avec Intersection Observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            conversationItems.forEach(item => {
                observer.observe(item);
            });
            
            // Auto-refresh avec notification
            let lastUpdateTime = Date.now();
            
            function checkForUpdates() {
                fetch(window.location.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.hasNewMessages) {
                        showNotification('Nouveaux messages reçus!');
                        // Optionnel: recharger la page ou mettre à jour le contenu
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la vérification des mises à jour:', error);
                });
            }
            
            // Vérifier les mises à jour toutes les 30 secondes
            setInterval(checkForUpdates, 30000);
            
            // Fonction de notification
            function showNotification(message) {
                if ('Notification' in window && Notification.permission === 'granted') {
                    new Notification(message, {
                        icon: '/favicon.ico',
                        badge: '/favicon.ico'
                    });
                }
            }
            
            // Demander la permission pour les notifications
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission();
            }
            
            // Animations de chargement pour les cartes de statistiques
            const statCards = document.querySelectorAll('.hover\\:scale-105');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fadeInUp');
            });
        });
    </script>
</x-app-layout>