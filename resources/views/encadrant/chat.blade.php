<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 p-4">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header avec informations de l'étudiant -->
            <div class="bg-white rounded-t-2xl shadow-sm border-b p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <!-- Bouton retour amélioré -->
                        <a href="{{ route('encadrant.conversations') }}" class="p-2 hover:bg-gray-100 rounded-xl transition-all duration-200 group">
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-indigo-600 group-hover:-translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        
                        <!-- Avatar et infos améliorés -->
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="h-14 w-14 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-semibold text-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                                    {{ substr($conversation->etudiant->user->name ?? '?', 0, 1) }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
                            </div>
                            <div>
                                <h1 class="text-xl font-semibold text-gray-900 hover:text-indigo-600 transition-colors duration-200">
                                    Discussion avec {{ $conversation->etudiant->user->name ?? 'Étudiant' }}
                                </h1>
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span class="bg-gray-100 px-2 py-1 rounded-full">Conversation #{{ $conversation->id }}</span>
                                    <span>•</span>
                                    <span>Dernière activité: {{ $conversation->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Actions et statut améliorés -->
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-green-600 bg-green-50 px-3 py-1.5 rounded-full border border-green-200">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="font-medium">En ligne</span>
                        </div>
                        
                        <!-- Menu d'actions amélioré -->
                        <div class="relative">
                            <button class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200 hover:rotate-90" onclick="toggleMenu()">
                                <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </button>
                            <div id="actionMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-10 animate-fadeIn">
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                    Archiver la conversation
                                </a>
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Exporter l'historique
                                </a>
                                <hr class="my-2 border-gray-100">
                                <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Zone de chat améliorée -->
            <div class="bg-white shadow-lg rounded-b-2xl overflow-hidden">
                
                <!-- Messages avec améliorations -->
                <div class="h-[500px] overflow-y-auto p-6 space-y-4 bg-gray-50/50" id="chat-box">
                    @forelse ($conversation->messages as $message)
                        <div class="flex gap-3 {{ $message->user_id == auth()->id() ? 'flex-row-reverse' : 'flex-row' }} message-item hover:bg-white/50 rounded-lg p-2 -m-2 transition-all duration-200" data-message-id="{{ $message->id }}">
                            
                            <!-- Avatar amélioré -->
                            <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center {{ $message->user_id == auth()->id() ? 'bg-indigo-100 text-indigo-600' : 'bg-blue-100 text-blue-600' }} hover:scale-110 transition-transform duration-200">
                                @if($message->user_id == auth()->id())
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Message Content amélioré -->
                            <div class="flex flex-col max-w-[70%] {{ $message->user_id == auth()->id() ? 'items-end' : 'items-start' }}">
                                <div class="rounded-2xl px-4 py-3 shadow-sm {{ $message->user_id == auth()->id() ? 'bg-indigo-600 text-white' : 'bg-white text-gray-900 border border-gray-200' }} hover:shadow-md transition-all duration-200 group">
                                    @if($message->user_id != auth()->id())
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-xs font-medium text-blue-600">{{ $message->user->name }}</span>
                                            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Étudiant</span>
                                        </div>
                                    @endif
                                    <p class="text-sm leading-relaxed">{{ $message->contenu }}</p>
                                    
                                    <!-- Actions de message (apparaissent au hover) -->
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 mt-2 flex items-center gap-2">
                                        <button class="text-xs {{ $message->user_id == auth()->id() ? 'text-indigo-200 hover:text-white' : 'text-gray-400 hover:text-gray-600' }} transition-colors duration-200">
                                            Répondre
                                        </button>
                                        <button class="text-xs {{ $message->user_id == auth()->id() ? 'text-indigo-200 hover:text-white' : 'text-gray-400 hover:text-gray-600' }} transition-colors duration-200">
                                            Copier
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Timestamp amélioré -->
                                <div class="flex items-center gap-2 mt-1 px-2">
                                    <span class="text-xs text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                        {{ $message->created_at->format('H:i') }}
                                        @if($message->created_at->isToday())
                                            <span class="text-green-600">(Aujourd'hui)</span>
                                        @elseif($message->created_at->isYesterday())
                                            <span class="text-yellow-600">(Hier)</span>
                                        @else
                                            <span class="text-gray-500">({{ $message->created_at->format('d/m/Y') }})</span>
                                        @endif
                                    </span>
                                    
                                    @if($message->user_id == auth()->id())
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-xs text-green-500">Envoyé</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center">
                            <div class="text-center animate-fadeIn">
                                <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 hover:scale-105 transition-transform duration-300">
                                    <svg class="h-10 w-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun message échangé</h3>
                                <p class="text-gray-500 mb-4">Commencez la conversation en envoyant votre premier message</p>
                                <div class="flex items-center justify-center gap-2 text-sm text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    L'étudiant sera notifié de votre message
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Zone de saisie améliorée -->
                <div class="border-t bg-white p-4">
                    <form action="{{ route('encadrant.chat.send', $conversation->id) }}" method="POST" class="flex gap-3" id="message-form">
                        @csrf
                        <div class="flex-1 relative">
                            <input 
                                type="text" 
                                name="contenu" 
                                id="message-input"
                                class="w-full px-4 py-3 pr-16 rounded-full border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-20 outline-none transition-all duration-200 hover:border-gray-300" 
                                placeholder="Écrire un message..." 
                                required
                                autocomplete="off"
                                maxlength="1000"
                            >
                            
                            <!-- Compteur de caractères -->
                            <div class="absolute right-12 top-3 text-xs text-gray-400" id="char-counter">0/1000</div>
                            
                            <!-- Bouton d'attachement amélioré -->
                            <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-indigo-600 transition-all duration-200 hover:scale-110" title="Joindre un fichier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-full transition-all duration-200 flex items-center justify-center min-w-[48px] shadow-sm hover:shadow-md hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="send-button"
                            disabled
                        >
                            <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
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
        /* Animations personnalisées améliorées */
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
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .message-item {
            animation: fadeInUp 0.3s ease-out;
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Scroll bar personnalisée améliorée */
        #chat-box::-webkit-scrollbar {
            width: 8px;
        }
        
        #chat-box::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        #chat-box::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #cbd5e1, #94a3b8);
            border-radius: 4px;
        }
        
        #chat-box::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #94a3b8, #64748b);
        }
        
        /* Animation du bouton d'envoi améliorée */
        #send-button:active {
            transform: scale(0.95);
        }
        
        /* Focus states améliorés */
        #message-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }
        
        /* Hover effects pour les messages */
        .message-item:hover {
            transform: translateY(-1px);
        }
        
        /* Animation du menu */
        #actionMenu {
            transform-origin: top right;
            animation: fadeIn 0.2s ease-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatBox = document.getElementById('chat-box');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');
            const charCounter = document.getElementById('char-counter');
            
            // Scroll automatique vers le bas avec animation fluide
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
            
            // Gestion du compteur de caractères et activation du bouton
            messageInput.addEventListener('input', function() {
                const length = this.value.length;
                charCounter.textContent = `${length}/1000`;
                
                // Activer/désactiver le bouton d'envoi
                sendButton.disabled = length === 0;
                
                // Changer la couleur du compteur
                if (length > 900) {
                    charCounter.classList.add('text-red-500');
                    charCounter.classList.remove('text-gray-400');
                } else if (length > 800) {
                    charCounter.classList.add('text-yellow-500');
                    charCounter.classList.remove('text-gray-400', 'text-red-500');
                } else {
                    charCounter.classList.add('text-gray-400');
                    charCounter.classList.remove('text-red-500', 'text-yellow-500');
                }
            });
            
            // Gestion du formulaire améliorée
            messageForm.addEventListener('submit', function(e) {
                const message = messageInput.value.trim();
                if (!message) {
                    e.preventDefault();
                    return;
                }
                
                // Animation du bouton avec feedback visuel
                sendButton.style.transform = 'scale(0.95)';
                sendButton.style.backgroundColor = '#4f46e5';
                setTimeout(() => {
                    sendButton.style.transform = 'scale(1)';
                    sendButton.style.backgroundColor = '';
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
            
            // Menu d'actions amélioré
            window.toggleMenu = function() {
                const menu = document.getElementById('actionMenu');
                menu.classList.toggle('hidden');
            };
            
            // Fermer le menu en cliquant ailleurs
            document.addEventListener('click', function(e) {
                const menu = document.getElementById('actionMenu');
                const button = e.target.closest('button[onclick="toggleMenu()"]');
                if (!button && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
            
            // Auto-refresh amélioré avec gestion d'erreurs
            let lastMessageId = {{ $conversation->messages->last()->id ?? 0 }};
            let isRefreshing = false;
            
            function checkForNewMessages() {
                if (isRefreshing) return;
                isRefreshing = true;
                
                fetch(window.location.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
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
            
            // Vérifier les nouveaux messages toutes les 8 secondes
            setInterval(checkForNewMessages, 8000);
            
            // Animation initiale des messages
            const messages = document.querySelectorAll('.message-item');
            messages.forEach((message, index) => {
                message.style.animationDelay = `${index * 0.05}s`;
            });
            
            // Focus automatique sur l'input
            messageInput.focus();
            
            // Fonctions utilitaires pour les actions de message
            window.copyMessage = function(text) {
                navigator.clipboard.writeText(text).then(() => {
                    // Feedback visuel
                    console.log('Message copié');
                });
            };
        });
    </script>
</x-app-layout>
