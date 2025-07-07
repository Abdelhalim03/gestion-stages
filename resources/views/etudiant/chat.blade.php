<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header amélioré -->
            <div class="bg-white rounded-t-2xl shadow-sm border-b p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <!-- Bouton retour vers le dashboard -->
                        <a href="{{ route('etudiant.stage.indexstage') }}" class="p-2 hover:bg-gray-100 rounded-xl transition-colors duration-200 group">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        
                        <!-- Avatar et informations de l'encadrant -->
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-md">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                </div>
                                <!-- Indicateur de statut en ligne -->
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold text-gray-900">Discussion avec votre encadrant</h1>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <span>{{ $conversation->supervisor->name ?? 'Encadrant' }}</span>
                                    <span>•</span>
                                    <span>Conversation #{{ $conversation->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions et statut -->
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-green-600 bg-green-50 px-3 py-1.5 rounded-full">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span>En ligne</span>
                        </div>
                        
                        <!-- Menu d'options -->
                        <div class="relative">
                            <button onclick="toggleOptionsMenu()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                            <div id="optionsMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-10">
                                <button onclick="exportChat()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Exporter la conversation
                                </button>
                                <button onclick="clearChat()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Effacer l'historique
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Container -->
            <div class="bg-white rounded-b-2xl shadow-lg overflow-hidden">
                
                <!-- Messages Area -->
                <div class="h-[500px] overflow-y-auto p-6 space-y-4 bg-gray-50/50" id="chat-box">
                    @forelse ($messages as $message)
                        <div class="flex gap-3 {{ $message->user_id == auth()->id() ? 'flex-row-reverse' : 'flex-row' }} message-item" data-message-id="{{ $message->id }}">
                            
                            <!-- Avatar -->
                            <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center {{ $message->user_id == auth()->id() ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                                @if($message->user_id == auth()->id())
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Message Content -->
                            <div class="flex flex-col max-w-[70%] {{ $message->user_id == auth()->id() ? 'items-end' : 'items-start' }}">
                                <div class="rounded-2xl px-4 py-3 shadow-sm {{ $message->user_id == auth()->id() ? 'bg-blue-600 text-white' : 'bg-white text-gray-900 border border-gray-200' }} group hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs font-medium {{ $message->user_id == auth()->id() ? 'text-blue-100' : 'text-gray-600' }}">
                                            {{ $message->user->name }}
                                        </span>
                                        @if($message->user_id != auth()->id())
                                            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Encadrant</span>
                                        @endif
                                    </div>
                                    <p class="text-sm leading-relaxed">{{ $message->contenu }}</p>
                                </div>
                                
                                <!-- Timestamp et statut -->
                                <div class="flex items-center gap-2 mt-1 px-2">
                                    <span class="text-xs text-gray-500">
                                        @if($message->created_at->isToday())
                                            Aujourd'hui {{ $message->created_at->format('H:i') }}
                                        @elseif($message->created_at->isYesterday())
                                            Hier {{ $message->created_at->format('H:i') }}
                                        @else
                                            {{ $message->created_at->format('d/m/Y H:i') }}
                                        @endif
                                    </span>
                                    
                                    @if($message->user_id == auth()->id())
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-xs text-gray-400">Envoyé</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-full text-gray-500">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Commencez votre conversation</h3>
                            <p class="text-gray-500 mb-4 text-center max-w-md">
                                Posez vos questions, partagez vos idées ou demandez des conseils à votre encadrant. 
                                Il sera notifié de votre message.
                            </p>
                            <div class="flex items-center gap-2 text-sm text-blue-600 bg-blue-50 px-4 py-2 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Votre encadrant recevra une notification
                            </div>
                        </div>
                    @endforelse

                    <!-- Indicateur de frappe -->
                    <div id="typing-indicator" class="hidden flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                        </div>
                        <div class="bg-white rounded-2xl px-4 py-3 shadow-sm border border-gray-200">
                            <div class="flex items-center gap-2">
                                <div class="flex gap-1">
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                    <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                </div>
                                <span class="text-xs text-gray-500">Votre encadrant écrit...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message Input amélioré -->
                <div class="border-t bg-white p-4 rounded-b-2xl">
                    <form action="{{ route('etudiant.chat.send', $conversation->id) }}" method="POST" class="flex gap-3" id="message-form">
                        @csrf
                        <div class="flex-1 relative">
                            <input 
                                type="text" 
                                name="contenu" 
                                id="message-input"
                                class="w-full px-4 py-3 pr-20 rounded-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-20 outline-none transition-all duration-200 placeholder-gray-400" 
                                placeholder="Tapez votre message..." 
                                required
                                autocomplete="off"
                                maxlength="1000"
                            >
                            
                            <!-- Compteur de caractères -->
                            <div class="absolute right-16 top-3 text-xs text-gray-400" id="char-counter">
                                0/1000
                            </div>
                            
                            <!-- Bouton emoji/attachement -->
                            <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors duration-200" title="Ajouter un emoji">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <button 
                            type="submit" 
                            id="send-button"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full transition-all duration-200 flex items-center justify-center min-w-[48px] shadow-sm hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span class="sr-only">Envoyer</span>
                        </button>
                    </form>
                    
                    <div class="flex items-center justify-between mt-3">
                        <p class="text-xs text-gray-500">Appuyez sur Entrée pour envoyer • Shift+Entrée pour une nouvelle ligne</p>
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Conversation sécurisée</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animations personnalisées */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .message-item {
            animation: fadeInUp 0.3s ease-out;
        }
        
        .message-item.from-user {
            animation: slideInRight 0.3s ease-out;
        }
        
        .message-item.from-supervisor {
            animation: slideInLeft 0.3s ease-out;
        }
        
        /* Scroll bar personnalisée */
        #chat-box::-webkit-scrollbar {
            width: 6px;
        }
        
        #chat-box::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        #chat-box::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        #chat-box::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Focus states améliorés */
        #message-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        
        /* Animation du bouton d'envoi */
        #send-button:active {
            transform: scale(0.95);
        }
        
        /* Hover effects pour les messages */
        .message-item:hover .group {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatBox = document.getElementById('chat-box');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');
            const charCounter = document.getElementById('char-counter');
            const typingIndicator = document.getElementById('typing-indicator');
            
            // Scroll automatique vers le bas
            function scrollToBottom(smooth = false) {
                if (smooth) {
                    chatBox.scrollTo({
                        top: chatBox.scrollHeight,
                        behavior: 'smooth'
                    });
                } else {
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            }
            
            // Scroll initial
            scrollToBottom();
            
            // Gestion du compteur de caractères
            messageInput.addEventListener('input', function() {
                const length = this.value.length;
                charCounter.textContent = `${length}/1000`;
                
                // Activer/désactiver le bouton d'envoi
                sendButton.disabled = length === 0;
                
                // Changer la couleur du compteur près de la limite
                if (length > 900) {
                    charCounter.classList.add('text-red-500');
                    charCounter.classList.remove('text-gray-400');
                } else {
                    charCounter.classList.add('text-gray-400');
                    charCounter.classList.remove('text-red-500');
                }
            });
            
            // Gestion du formulaire
            messageForm.addEventListener('submit', function(e) {
                const message = messageInput.value.trim();
                if (!message) {
                    e.preventDefault();
                    return;
                }
                
                // Animation du bouton
                sendButton.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    sendButton.style.transform = 'scale(1)';
                }, 150);
                
                // Scroll après envoi
                setTimeout(() => scrollToBottom(true), 100);
            });
            
            // Envoi avec Entrée (mais pas Shift+Entrée)
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    if (this.value.trim()) {
                        messageForm.submit();
                    }
                }
            });
            
            // Simulation d'indicateur de frappe
            let typingTimer;
            messageInput.addEventListener('input', function() {
                clearTimeout(typingTimer);
                if (Math.random() > 0.85 && this.value.length > 5) { // 15% de chance après 5 caractères
                    typingIndicator.classList.remove('hidden');
                    scrollToBottom(true);
                    typingTimer = setTimeout(() => {
                        typingIndicator.classList.add('hidden');
                    }, 3000);
                }
            });
            
            // Fonctions pour le menu d'options
            window.toggleOptionsMenu = function() {
                const menu = document.getElementById('optionsMenu');
                menu.classList.toggle('hidden');
            };
            
            window.exportChat = function() {
                // Logique d'export (à implémenter côté serveur)
                alert('Fonctionnalité d\'export en cours de développement');
                document.getElementById('optionsMenu').classList.add('hidden');
            };
            
            window.clearChat = function() {
                if (confirm('Êtes-vous sûr de vouloir effacer l\'historique de cette conversation ?')) {
                    // Logique de suppression (à implémenter côté serveur)
                    alert('Fonctionnalité de suppression en cours de développement');
                }
                document.getElementById('optionsMenu').classList.add('hidden');
            };
            
            // Fermer le menu en cliquant ailleurs
            document.addEventListener('click', function(e) {
                const menu = document.getElementById('optionsMenu');
                const button = e.target.closest('button[onclick="toggleOptionsMenu()"]');
                if (!button && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
            
            // Auto-refresh amélioré avec gestion des erreurs
            let lastMessageId = {{ $messages->last()->id ?? 0 }};
            let isRefreshing = false;
            
            function checkForNewMessages() {
                if (isRefreshing) return;
                isRefreshing = true;
                
                fetch(window.location.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newChatBox = doc.getElementById('chat-box');
                    const newMessages = newChatBox.querySelectorAll('.message-item');
                    
                    if (newMessages.length > 0) {
                        const newLastMessageId = parseInt(newMessages[newMessages.length - 1].dataset.messageId);
                        if (newLastMessageId > lastMessageId) {
                            chatBox.innerHTML = newChatBox.innerHTML;
                            scrollToBottom(true);
                            lastMessageId = newLastMessageId;
                            
                            // Animation pour les nouveaux messages
                            const messages = chatBox.querySelectorAll('.message-item');
                            messages.forEach((message, index) => {
                                message.style.animationDelay = `${index * 0.05}s`;
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la vérification des nouveaux messages:', error);
                })
                .finally(() => {
                    isRefreshing = false;
                });
            }
            
            // Vérifier les nouveaux messages toutes les 15 secondes
            setInterval(checkForNewMessages, 15000);
            
            // Animation initiale des messages
            const messages = document.querySelectorAll('.message-item');
            messages.forEach((message, index) => {
                message.style.animationDelay = `${index * 0.05}s`;
                // Ajouter des classes d'animation spécifiques
                if (message.classList.contains('flex-row-reverse')) {
                    message.classList.add('from-user');
                } else {
                    message.classList.add('from-supervisor');
                }
            });
            
            // Focus automatique sur l'input
            messageInput.focus();
        });
    </script>
</x-app-layout>