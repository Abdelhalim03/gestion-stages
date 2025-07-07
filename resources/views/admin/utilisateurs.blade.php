<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Premier Tableau : Gestion des Utilisateurs -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Gestion des Utilisateurs</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ $users->total() }} utilisateurs enregistrés</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="*" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Ajouter un utilisateur
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filtres pour le premier tableau -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="role" class="block text-xs font-medium text-gray-700 mb-1">Filtrer par rôle</label>
                            <select name="role" id="role" class="block w-full pl-3 pr-10 py-2 text-xs border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                                <option value="">Tous les rôles</option>
                                <option value="etudiant" {{ request('role') === 'etudiant' ? 'selected' : '' }}>Étudiants</option>
                                <option value="encadrant" {{ request('role') === 'encadrant' ? 'selected' : '' }}>Encadrants</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrateurs</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Recherche</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nom ou email" class="block w-full pl-10 pr-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Appliquer
                            </button>
                            @if(request('role') || request('search'))
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-xs font-medium rounded shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Réinitialiser
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Tableau des utilisateurs -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}">
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $user->role === 'etudiant' ? 'bg-blue-100 text-blue-800' : 
                                           ($user->role === 'encadrant' ? 'bg-green-100 text-green-800' : 
                                           'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900" title="Modifier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                    
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this.form)" class="text-red-600 hover:text-red-900" title="Supprimer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="mt-2 text-sm font-medium">Aucun utilisateur trouvé</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
    {{ $users->appends(request()->except('page'))->links() }}
</div>
            </div>

            <!-- Deuxième Tableau : Gestion des Projets -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Gestion des Projets Étudiants</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ $etudiants->count() }} projets enregistrés</p>
                </div>

                <!-- Filtres pour le deuxième tableau -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="statut_rapport" class="block text-xs font-medium text-gray-700 mb-1">Statut Rapport</label>
                            <select name="statut_rapport" id="statut_rapport" class="block w-full pl-3 pr-10 py-2 text-xs border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                                <option value="">Tous les statuts</option>
                                <option value="validé" {{ request('statut_rapport') === 'validé' ? 'selected' : '' }}>Validé</option>
                                <option value="en attente" {{ request('statut_rapport') === 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="refusé" {{ request('statut_rapport') === 'refusé' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="statut_presentation" class="block text-xs font-medium text-gray-700 mb-1">Statut Présentation</label>
                            <select name="statut_presentation" id="statut_presentation" class="block w-full pl-3 pr-10 py-2 text-xs border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                                <option value="">Tous les statuts</option>
                                <option value="validé" {{ request('statut_presentation') === 'validé' ? 'selected' : '' }}>Validé</option>
                                <option value="en attente" {{ request('statut_presentation') === 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="refusé" {{ request('statut_presentation') === 'refusé' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="search_projet" class="block text-xs font-medium text-gray-700 mb-1">Recherche</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search_projet" id="search_projet" value="{{ request('search_projet') }}" placeholder="Étudiant, encadrant ou sujet" class="block w-full pl-10 pr-3 py-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Appliquer
                            </button>
                            @if(request('statut_rapport') || request('statut_presentation') || request('search_projet'))
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-xs font-medium rounded shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Réinitialiser
                            </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Tableau des projets -->
                 <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Étudiant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Encadrant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sujet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Documents</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statuts</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($etudiants as $etudiant)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($etudiant->user->name) }}&background=random" alt="">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $etudiant->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $etudiant->user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($etudiant->encadrant)
                            <div class="text-sm font-medium text-gray-900">{{ $etudiant->encadrant->name }}</div>
                            <div class="text-xs text-gray-500">{{ $etudiant->encadrant->email }}</div>
                            @else
                            <span class="text-xs text-gray-400">Non assigné</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $etudiant->sujet ?? '—' }}</div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-1">
                                @if ($etudiant->rapport)
                                <a href="{{ asset('storage/' . $etudiant->rapport) }}" class="text-xs text-blue-600 hover:text-blue-800" target="_blank">📄 Rapport</a>
                                @else
                                <span class="text-xs text-gray-400">Aucun rapport</span>
                                @endif

                                @if ($etudiant->presentation)
                                <a href="{{ asset('storage/' . $etudiant->presentation) }}" class="text-xs text-green-600 hover:text-green-800" target="_blank">🎞 Présentation</a>
                                @else
                                <span class="text-xs text-gray-400">Aucune présentation</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col space-y-1 text-xs">
                                <span class="inline-block px-2 py-1 rounded 
                                    {{ $etudiant->statut_rapport === 'validé' ? 'bg-green-100 text-green-800' : 
                                       ($etudiant->statut_rapport === 'refusé' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    Rapport: {{ ucfirst($etudiant->statut_rapport ?? 'en attente') }}
                                </span>

                                <span class="inline-block px-2 py-1 rounded 
                                    {{ $etudiant->statut_presentation === 'validé' ? 'bg-green-100 text-green-800' : 
                                       ($etudiant->statut_presentation === 'refusé' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    Présentation: {{ ucfirst($etudiant->statut_presentation ?? 'en attente') }}
                                </span>

                                <span class="inline-block px-2 py-1 rounded 
                                    {{ $etudiant->validation_admin === 'validé' ? 'bg-green-100 text-green-800' : 
                                       ($etudiant->validation_admin === 'refusé' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    Admin: {{ ucfirst($etudiant->validation_admin ?? 'en attente') }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                            <div class="flex justify-end space-x-2">
                                <!-- Validation admin -->
                                <form action="{{ route('admin.valider.projet', $etudiant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800" title="Valider le projet">
                                        ✅
                                    </button>
                                </form>

                                <form action="{{ route('admin.refuser.projet', $etudiant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Refuser le projet">
                                        ❌
                                    </button>
                                </form>

                                <!-- Modifier utilisateur -->
                                <a href="{{ route('admin.users.edit', $etudiant->user) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                                    ✏️
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-sm text-gray-500">Aucun projet trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mb-4 text-right">
    <a href="{{ route('admin.etudiants.export') }}" 
       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
       Télécharger Excel
    </a>
</div>

                <!-- Pagination -->
                <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
    {{ $etudiants->appends(request()->except('page'))->links() }}
</div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(form) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                form.submit();
            }
        }
    </script>
</x-app-layout>