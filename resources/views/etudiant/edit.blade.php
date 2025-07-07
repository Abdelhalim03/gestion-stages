
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Modifier le profil</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('etudiants.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Filière -->
            <div class="mb-4">
                <label>Filière</label>
                <input type="text" name="filiere" value="{{ old('filiere', $etudiant->filiere) }}" class="w-full border p-2">
            </div>

            <!-- Niveau -->
            <div class="mb-4">
                <label>Niveau</label>
                <input type="text" name="niveau" value="{{ old('niveau', $etudiant->niveau) }}" class="w-full border p-2">
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label>Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" class="w-full border p-2">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $etudiant->email) }}" class="w-full border p-2">
            </div>

            <!-- Établissement -->
            <div class="mb-4">
                <label>Établissement</label>
                <input type="text" name="etablissement" value="{{ old('etablissement', $etudiant->etablissement) }}" class="w-full border p-2">
            </div>

            <!-- Encadrant -->
<div class="mb-4">
    <label for="encadrant_id" class="block text-sm font-medium text-gray-700">Encadrant</label>
    <select name="encadrant_id" id="encadrant_id" required class="mt-1 block w-full border rounded p-2">
        <option value="">-- Sélectionnez un encadrant --</option>
        @foreach($encadrants as $encadrant)
            <option value="{{ $encadrant->id }}" {{ old('encadrant_id', $etudiant->encadrant_id) == $encadrant->id ? 'selected' : '' }}>


                   {{ $encadrant->user->name }}
            </option>
        @endforeach
    </select>
</div>




        


            <!-- Rapport -->
            <div class="mb-4">
                <label>Rapport de stage (PDF)</label>
                <input type="file" name="rapport" accept="application/pdf" class="w-full border p-2">
                @if ($etudiant->rapport)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $etudiant->rapport) }}" target="_blank" class="text-blue-600 underline">Voir le rapport actuel</a>
                    </div>
                @endif
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
