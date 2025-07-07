<!-- NAVBAR -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-indigo-600" />
                        <span class="ml-2 text-xl font-bold text-gray-800 hidden md:block">StagePro</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex">
                    {{-- Étudiant --}}
                    @if (Auth::user()->role === 'etudiant')
                        <x-nav-link :href="route('etudiant.dashboard')" :active="request()->routeIs('etudiant.dashboard')">
                            <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                        </x-nav-link>
                        <x-nav-link :href="route('etudiant.stage.indexstage')" :active="request()->routeIs('etudiant.stage.indexstage')">
                            <i class="fas fa-briefcase mr-2"></i> Stages
                        </x-nav-link>
                        <x-nav-link :href="route('etudiant.pfe.indexpfe')" :active="request()->routeIs('etudiant.pfe.indexpfe')">
                            <i class="fas fa-graduation-cap mr-2"></i> PFE
                        </x-nav-link>
                         <x-nav-link :href="route('etudiant.chat')" :active="request()->routeIs('etudiant.chat')">
                            <i class="fas fa-circle text-xs mr-2"></i> Contact 
                        </x-nav-link>
                       
                    @endif

                    {{-- Encadrant --}}
                    @if (Auth::user()->role === 'encadrant')
                        <x-nav-link :href="route('encadrant.dashboard')" :active="request()->routeIs('encadrant.dashboard')">
                            <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                        </x-nav-link>
                        <x-nav-link :href="route('encadrant.conversations')" :active="request()->routeIs('encadrant.conversations')">
                            <i class="fas fa-circle text-xs mr-2"></i> Conversations 
                        </x-nav-link>
                    @endif

                    {{-- Admin --}}
                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <i class="fas fa-tachometer-alt mr-2"></i> Administration
                        </x-nav-link>
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                            <i class="fas fa-users-cog mr-2"></i> Utilisateurs
                        </x-nav-link>
                    @endif

                    {{-- Tous les rôles --}}
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <i class="fas fa-home mr-2"></i> Accueil
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Of Navbar -->
            <div class="flex items-center">
                <!-- Profile Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-indigo-600 focus:outline-none transition ease-in-out duration-150 group">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold mr-2">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="group-hover:text-indigo-600">{{ Auth::user()->name }}</span>
                                    <svg class="ms-1 h-4 w-4 text-gray-400 group-hover:text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="group">
                                <i class="fas fa-user-cog mr-2 text-gray-400 group-hover:text-indigo-600"></i>
                                {{ __('Mon Profil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="group">
                                    <i class="fas fa-sign-out-alt mr-2 text-gray-400 group-hover:text-indigo-600"></i>
                                    {{ __('Déconnexion') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger for mobile -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open }" viewBox="0 0 24 24" fill="none">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg class="h-6 w-6" :class="{'hidden': !open, 'block': open }" viewBox="0 0 24 24" fill="none">
                            <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="sm:hidden" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="pt-2 pb-3 space-y-1 bg-white shadow-lg rounded-b-lg mx-2">
            @if (Auth::user()->role === 'etudiant')
                <x-responsive-nav-link :href="route('etudiant.dashboard')" :active="request()->routeIs('etudiant.dashboard')">
                    <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('etudiant.stage.indexstage')" :active="request()->routeIs('etudiant.stage.indexstage')">
                    <i class="fas fa-briefcase mr-2"></i> Stages
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('etudiant.pfe.indexpfe')" :active="request()->routeIs('etudiant.pfe.indexpfe')">
                    <i class="fas fa-graduation-cap mr-2"></i> PFE
                </x-responsive-nav-link>
            @endif

            @if (Auth::user()->role === 'encadrant')
                <x-responsive-nav-link :href="route('encadrant.dashboard')" :active="request()->routeIs('encadrant.dashboard')">
                    <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                </x-responsive-nav-link>
            @endif

            @if (Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <i class="fas fa-tachometer-alt mr-2"></i> Administration
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                    <i class="fas fa-users-cog mr-2"></i> Utilisateurs
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <i class="fas fa-home mr-2"></i> Accueil
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <i class="fas fa-user-cog mr-2"></i> Profil
            </x-responsive-nav-link>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <i class="fas fa-user-edit mr-2"></i> {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Déconnexion') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

