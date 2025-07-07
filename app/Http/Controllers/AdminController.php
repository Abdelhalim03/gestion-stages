<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Encadrant;
use App\Models\Etudiant;
use App\Models\User;
use App\Exports\EtudiantsExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function stages()
    {
        return view('admin.stages');
    }

    public function dashboard()
{
    $etudiantsCount = \App\Models\Etudiant::count();
    $encadrantsCount = \App\Models\Encadrant::count();
    $rapportsCount = \App\Models\Etudiant::whereNotNull('rapport')->count();

    // 🔢 Étudiants par filière
    $etudiantsParFiliere = \App\Models\Etudiant::select('filiere', DB::raw('count(*) as total'))
        ->groupBy('filiere')
        ->get();
    $rapportsParMois = \App\Models\Etudiant::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
    ->whereNotNull('rapport')
    ->groupBy('mois')
    ->orderBy('mois')
    ->get();

$labelsMois = [];
$valeursMois = [];

foreach ($rapportsParMois as $rapport) {
    $labelsMois[] = Carbon::create()->month($rapport->mois)->locale('fr')->translatedFormat('F'); // nom du mois en français
    $valeursMois[] = $rapport->total;
}    
$rolesCount = \App\Models\User::select('role', DB::raw('count(*) as total'))
    ->groupBy('role')
    ->get();

$labelsRoles = $rolesCount->pluck('role');
$valeursRoles = $rolesCount->pluck('total');
$derniersUtilisateurs = \App\Models\User::latest()->take(5)->get();


    return view('admin.dashboard', compact(
    'etudiantsCount',
    'encadrantsCount',
    'rapportsCount',
    'etudiantsParFiliere',
    'labelsMois',
    'valeursMois',
    'labelsRoles',
'valeursRoles',
'derniersUtilisateurs'

));
}


public function utilisateurs(Request $request)
{
    // Requête pour les utilisateurs
    $usersQuery = \App\Models\User::with('etudiant');

    // Filtres User
    if ($request->filled('search')) {
        $usersQuery->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('role')) {
        $usersQuery->where('role', $request->role);
    }

    $users = $usersQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'users_page');

    // Requête pour les étudiants
    $etudiantsQuery = Etudiant::with(['user', 'encadrant.user']);

    // Filtres Etudiants
    if ($request->filled('search_projet')) {
        $etudiantsQuery->where(function ($q) use ($request) {
            $q->where('sujet', 'like', '%' . $request->search_projet . '%')
              ->orWhereHas('user', function ($q) use ($request) {
                  $q->where('name', 'like', '%' . $request->search_projet . '%');
              })
              ->orWhereHas('encadrant.user', function ($q) use ($request) {
                  $q->where('name', 'like', '%' . $request->search_projet . '%');
              });
        });
    }

    if ($request->filled('statut_rapport')) {
        $etudiantsQuery->where('statut_rapport', $request->statut_rapport);
    }

    if ($request->filled('statut_presentation')) {
        $etudiantsQuery->where('statut_presentation', $request->statut_presentation);
    }

    $etudiants = $etudiantsQuery->latest()->paginate(10, ['*'], 'etudiants_page');

    return view('admin.utilisateurs', compact('users', 'etudiants'));
}



public function destroyUser(User $user)
{
    $user->delete();

    return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
}
public function edit(User $user)
{
    return view('admin.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'role' => 'required|in:etudiant,encadrant,admin',
    ]);

    $user->update($validated);

    return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès');
}
public function validerRapport($id)
{
    Etudiant::where('id', $id)->update(['statut_rapport' => 'validé']);
    return back()->with('success', 'Rapport validé avec succès.');
}

public function refuserRapport($id)
{
    Etudiant::where('id', $id)->update(['statut_rapport' => 'refusé']);
    return back()->with('error', 'Rapport refusé.');
}
public function validerProjet($id)
{
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->validation_admin = 'validé';
    $etudiant->save();

    // Notifier (optionnel)
    // Notification::send($etudiant->user, new ValidationAdminNotification(true));

    return back()->with('success', 'Projet validé avec succès.');
}

public function refuserProjet($id)
{
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->validation_admin = 'refusé';
    $etudiant->save();

    // Notification optionnelle ici aussi

    return back()->with('success', 'Projet refusé avec succès.');
}

public function exportEtudiantsExcel()
{
    return Excel::download(new EtudiantsExport, 'etudiants-projets.xlsx');
}



}
