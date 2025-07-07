<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Encadrant;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EtudiantWelcomeEmail;

class EtudiantController extends Controller
{
    public function create()
{
    $encadrants = Encadrant::with('user')->get(); // 💡 charger le user associé
    return view('etudiant.create', compact('encadrants'));
}
public function dashboard()
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();

    return view('etudiant.dashboard', compact('etudiant'));
}


public function stage()
{
    $etudiant = Etudiant::where('user_id', Auth::id())->with('encadrant')->first();
    

    // Charger l'encadrant lié
    $encadrant = $etudiant->encadrant;
    
    return view('etudiant.stage.indexstage', compact('etudiant', 'encadrant'));
}



public function storeStage(Request $request)
{
    $request->validate([
        'rapport_stage' => 'required|mimes:pdf|max:5120',
    ]);

    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    $etudiant->rapport_stage = $request->file('rapport_stage')->store('rapports_stage', 'public');
    $etudiant->save();


    return back()->with('success', 'Rapport de stage téléchargé avec succès.');
}

public function pfe()
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    return view('etudiant.pfe.indexpfe', compact('etudiant'));
}

public function storePfe(Request $request)
{
    $request->validate([
        'rapport_pfe' => 'required|mimes:pdf|max:5120',
    ]);

    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    $etudiant->rapport_pfe = $request->file('rapport_pfe')->store('rapports_pfe', 'public');
    $etudiant->save();

    return back()->with('success', 'Rapport PFE téléchargé avec succès.');
}
public function storeRapportStage(Request $request)
{
    $request->validate([
        'rapport' => 'required|mimes:pdf|max:5120',
    ]);

    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();

    // Stocker le fichier dans /public/rapports/
    $pdf = $request->file('rapport');
    $pdfName = time() . '_' . $pdf->getClientOriginalName();
    $pdf->move(public_path('rapports'), $pdfName);

    $etudiant->rapport = $pdfName;
    $etudiant->save();

    return back()->with('success', 'Rapport de stage déposé avec succès.');
}

public function editStageInfo()
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    return view('etudiant.stage.editstageinfo', compact('etudiant'));
}

public function updateStageInfo(Request $request)
{
    $request->validate([
    'entreprise' => 'required|string|max:255',
    'duree' => 'required|string|max:255',
    'sujet' => 'required|string',
    ]);
    

    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();

   $etudiant->entreprise = $request->entreprise;
$etudiant->duree = $request->duree;
$etudiant->sujet = $request->sujet;

    $etudiant->save();

    return redirect()->route('etudiant.stage.edit')->with('success', 'Infos du stage enregistrées avec succès.');
}
public function editPfeInfo()
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    return view('etudiant.pfe.editpfeinfo', compact('etudiant'));
}

public function updatePfeInfo(Request $request)
{
    $request->validate([
        'titre_pfe' => 'required|string|max:255',
        'duree_pfe' => 'required|string|max:255',
        'sujet_pfe' => 'required|string',
    ]);

    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    $etudiant->titre_pfe = $request->titre_pfe;
    $etudiant->duree_pfe = $request->duree_pfe;
    $etudiant->sujet_pfe = $request->sujet_pfe;
    $etudiant->save();

    return redirect()->route('etudiant.pfe.indexpfe')->with('success', 'Informations PFE enregistrées.');

}
public function storeRapportPfe(Request $request)
{
    $request->validate([
        'rapport_pfe' => 'required|mimes:pdf|max:5120',
    ]);

    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();

    $etudiant->rapport_pfe = $request->file('rapport_pfe')->store('rapports_pfe', 'public');
    $etudiant->save();

    return back()->with('success', 'Rapport PFE téléchargé avec succès.');
}






public function store(Request $request)
{
    $request->validate([
        'filiere'       => 'required|string|max:255',
        'niveau'        => 'required|string|max:255',
        'telephone'     => 'required|regex:/^\+212[0-9]{9}$/',
        'email'         => 'required|email',
        'etablissement' => 'required|string|max:255',
        'rapport'       => 'nullable|mimes:pdf|max:5120', // 5 Mo max
        'encadrant_id'   => 'required|exists:encadrants,id',

    ]);

    $etudiant = new Etudiant();
    $etudiant->filiere       = $request->filiere;
    $etudiant->niveau        = $request->niveau;
    $etudiant->telephone     = $request->telephone;
    $etudiant->email         = $request->email;
    $etudiant->etablissement = $request->etablissement;
    $etudiant->user_id       = auth()->id(); // 🔐 Lier à l'utilisateur connecté
    $etudiant->encadrant_id  = $request->encadrant_id;
         

    /* ---------- RAPPORT PDF ---------- */
    if ($request->hasFile('rapport')) {
        $pdf       = $request->file('rapport');
        $pdfName   = time() . '_' . $pdf->getClientOriginalName();
        $pdf->move(public_path('rapports'), $pdfName);           //   public/rapports/…
        $etudiant->rapport = $pdfName;                           // on stocke juste le nom
    }

    $etudiant->save();

     Mail::to($etudiant->email)->send(new EtudiantWelcomeEmail($etudiant));

    return redirect()->route('etudiants.show')     // plus d’ID nécessaire
                     ->with('success', 'Profil étudiant créé avec succès.');
}



public function show()
{
    $userId = auth()->id();
    $etudiant = Etudiant::where('user_id', $userId)->firstOrFail();

    return view('etudiant.show', compact('etudiant'));
}

// Afficher le formulaire d'édition

public function edit($id)
{
    $etudiant = Etudiant::findOrFail($id);
        $encadrants = Encadrant::all(); // ou un filtre si besoin
    return view('etudiant.edit', compact('etudiant', 'encadrants'));
}


// Mettre à jour les informations
public function update(Request $request)
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();

    $validated = $request->validate([
        'filiere' => 'required|string|max:255',
        'niveau' => 'required|string|max:255',
        'telephone' => 'required|regex:/^\+212[0-9]{9}$/',
        'email' => 'required|email',
        'etablissement' => 'required|string|max:255',
        'rapport' => 'nullable|mimes:pdf|max:5120',
        
    ]);

    $etudiant->update($validated);

    return redirect()->route('etudiants.show')->with('success', 'Profil mis à jour avec succès.');

    if ($request->hasFile('rapport')) {
    $etudiant->rapport = $request->file('rapport')->store('rapports', 'public');
}
}

// Supprimer le profil
public function destroy()
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    $etudiant->delete();

    return redirect()->route('etudiant.dashboard')->with('success', 'Profil supprimé.');
}

  public function editProfile()
    {
        $etudiant = Auth::user();

        // Récupérer tous les utilisateurs (ou filtrer si besoin)
        $encadrants = User::all();

        return view('etudiant.edit', compact('etudiant', 'encadrants'));
    }


public function updateProfile(Request $request)
{
    $request->validate([
        'encadrant_id' => 'required|exists:users,id',
        // autres validations...
    ]);

    $etudiant = Auth::user();

    $etudiant->update([
        'encadrant_id' => $request->encadrant_id,
        // autres champs si besoin
    ]);

    return redirect()->route('etudiant.profile.edit')->with('success', 'Profil mis à jour');
}

public function uploadPresentation(Request $request)
{
    $request->validate([
        'presentation' => 'required|file|mimes:ppt,pptx,pdf|max:10240',
    ]);

    $etudiant = Etudiant::where('user_id', Auth::id())->first();

    if (!$etudiant) {
        return redirect()->back()->with('error', 'Étudiant non trouvé.');
    }

    $file = $request->file('presentation');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('presentations'), $filename);

    $etudiant->presentation = $filename;
    $etudiant->save();

    return redirect()->back()->with('success', 'Présentation déposée avec succès.');
}
public function marquerNotificationsLues()
{
    $etudiant = auth()->user()->etudiant; // ou ta relation
    $etudiant->notification_non_lue = false;
    $etudiant->save();

    return redirect()->route('etudiant.stage.indexstage')->with('success', 'Notifications marquées comme lues.');
}

public function projetEtudiant()
{
    $etudiant = auth()->user()->etudiant; // ou selon ta relation
    return view('etudiant.projet', compact('etudiant'));
}
public function historiqueCommentaires()
{
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();

    $historiquesCommentaires = $etudiant->modificationHistories()
        ->whereNotNull('commentaire')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('etudiant.historique_commentaires', compact('historiquesCommentaires'));
}









}
