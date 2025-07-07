<?php

namespace App\Http\Controllers;

use App\Models\ModificationHistory;
use App\Models\Encadrant;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncadrantController extends Controller
{
   public function create()
{
    $users = User::all(); // Ou filtrer les users avec rôle "encadrant"
    return view('encadrant.create');
}

    public function store(Request $request)
{
    $request->validate([
        'specialite' => 'required|string|max:255',
        'telephone'  => 'required|regex:/^\+212[0-9]{9}$/',
        'email'      => 'required|email|unique:encadrants,email',
    ]);

    // Créer le nouvel encadrant lié à l'utilisateur connecté
    Encadrant::create([
        'user_id'    => Auth::id(), // 🔥 Auto-liaison !
        'specialite' => $request->specialite,
        'telephone'  => $request->telephone,
        'email'      => $request->email,
    ]);

    return redirect()->route('encadrant.dashboard')->with('success', 'Encadrant ajouté avec succès.');
}
  

public function show($id)
{
    $encadrant = Encadrant::findOrFail($id);
    return view('encadrant.show', compact('encadrant',));
}

public function edit($id)
{
    $encadrant = Encadrant::findOrFail($id);
    // Optionnel : vérifier que l'encadrant appartient bien à l'utilisateur connecté
    if ($encadrant->user_id !== Auth::id()) {
        abort(403);
    }
    return view('encadrant.edit', compact('encadrant'));
}
public function update(Request $request, $id)
{
    $encadrant = Encadrant::findOrFail($id);
    if ($encadrant->user_id !== Auth::id()) {
        abort(403);
    }

    $request->validate([
        'specialite' => 'required|string|max:255',
        'telephone'  => 'required|regex:/^\+212[0-9]{9}$/',
        'email'      => 'required|email|unique:encadrants,email,' . $encadrant->id,
    ]);

    $encadrant->update([
        'specialite' => $request->specialite,
        'telephone'  => $request->telephone,
        'email'      => $request->email,
    ]);

    return redirect()->route('encadrant.show', $encadrant->id)
                     ->with('success', 'Informations mises à jour avec succès.');
}



public function dashboard()
{
    $encadrant = Encadrant::with(['etudiants' => function ($query) {
        $query->when(request('search'), function ($q) {
            $q->where('email', 'like', '%' . request('search') . '%');
        })
        ->when(request('filiere'), fn($q) => $q->where('filiere', request('filiere')))
        ->when(request('niveau'), fn($q) => $q->where('niveau', request('niveau')))
        ->when(request('statut_rapport'), fn($q) => $q->where('statut_rapport', request('statut_rapport')))
        ->when(request('statut_presentation'), fn($q) => $q->where('statut_presentation', request('statut_presentation')));
    }])->where('user_id', Auth::id())->first();

    if (!$encadrant) {
        return redirect()->route('encadrant.create')->with('error', 'Veuillez compléter votre profil avant d\'accéder au tableau de bord.');
    }

    // Préparation des statistiques sur les étudiants filtrés
    $etudiants = $encadrant->etudiants;

    // Nombre d'étudiants par filière
    $etudiantsParFiliere = $etudiants->groupBy('filiere')->map->count()->toArray();

    // Nombre d'étudiants par statut de rapport
    $statutsRapport = $etudiants->groupBy('statut_rapport')->map->count();

    // Nombre d'étudiants par statut de présentation
    $statutsPresentation = $etudiants->groupBy('statut_presentation')->map->count();

    return view('encadrant.dashboard', compact('encadrant', 'etudiantsParFiliere', 'etudiants'));
}





public function validerRapport($id)
{
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->statut_validation = 'valide';
    $etudiant->save();

    return back()->with('success', 'Rapport validé avec succès.');
}

public function refuserRapport($id)
{
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->statut_validation = 'refuse';
    $etudiant->save();

    return back()->with('error', 'Rapport refusé.');
}
public function updateStatut(Request $request, Etudiant $etudiant)
{
    $request->validate([
        'statut' => 'required|in:valide,refuse,en_attente',
    ]);

    $etudiant->statut = $request->statut;
    $etudiant->save();

    return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
}
public function validerPre(Request $request, $id)
{
    $request->validate([
        'statut' => 'required|in:En attente,Validé,Refusé',
    ]);

    $etudiant = Etudiant::findOrFail($id);
    $etudiant->statut_rapport = $request->statut;
    $etudiant->save();

    return redirect()->back()->with('success', 'Statut du rapport mis à jour.');
}
public function updateStatutRapport(Request $request, $id)
{
    $etudiant = Etudiant::findOrFail($id);

    $ancienStatut = $etudiant->statut_rapport; // sauvegarder l'ancien

    $etudiant->statut_rapport = $request->statut_rapport;
    $etudiant->notification_non_lue = true;
    $etudiant->save();

    // Historique de modification
    ModificationHistory::create([
        'etudiant_id'    => $etudiant->id,
        'type'           => 'rapport',
        'ancien_statut'  => $ancienStatut,
        'nouveau_statut' => $request->statut_rapport,
        'commentaire'    => null, // tu peux ajouter un champ si tu veux
        'updated_by'     => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Statut rapport mis à jour.');
}


public function updateStatutPresentation(Request $request, $id)
{
    $etudiant = Etudiant::findOrFail($id);

    $ancienStatut = $etudiant->statut_presentation;

    $etudiant->statut_presentation = $request->statut_presentation;
    $etudiant->notification_non_lue = true;
    $etudiant->save();

    // Historique de modification
    ModificationHistory::create([
        'etudiant_id'    => $etudiant->id,
        'type'           => 'présentation',
        'ancien_statut'  => $ancienStatut,
        'nouveau_statut' => $request->statut_presentation,
        'commentaire'    => null,
        'updated_by'     => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Statut présentation mis à jour.');
}


public function updateCommentaireRapport(Request $request, $id)
{
    $request->validate(['commentaire_rapport' => 'nullable|string']);
    
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->commentaire_rapport = $request->commentaire_rapport;
    $etudiant->save();
    ModificationHistory::create([
    'etudiant_id' => $etudiant->id,
    'type' => 'rapport',
    'ancien_statut' => '',
    'nouveau_statut' => '',
    'commentaire' => $request->commentaire_rapport,
    'updated_by' => Auth::id(),
]);

    return back()->with('success', 'Commentaire du rapport mis à jour.');
}

public function updateCommentairePresentation(Request $request, $id)
{
    $request->validate(['commentaire_presentation' => 'nullable|string']);

    $etudiant = Etudiant::findOrFail($id);
    $etudiant->commentaire_presentation = $request->commentaire_presentation;
    $etudiant->save();

    return back()->with('success', 'Commentaire de la présentation mis à jour.');
}


public function updateDates(Request $request)
{
    $request->validate([
        'date_limite_rapport' => 'nullable|date',
        'date_soutenance' => 'nullable|date',
    ]);

    $encadrant = Encadrant::where('user_id', Auth::id())->first();
    if ($encadrant) {
        $encadrant->update([
            'date_limite_rapport' => $request->date_limite_rapport,
            'date_soutenance' => $request->date_soutenance,
        ]);
    }

    return back()->with('success', 'Dates mises à jour avec succès.');
}

public function projetsEncadrant()
{
    $encadrant = auth()->user()->encadrant;
    $etudiants = $encadrant->etudiants()->with('user')->get(); // Assure-toi de la relation

    return view('encadrant.projets', compact('etudiants'));
}

}
