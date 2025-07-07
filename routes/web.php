<?php
use App\Http\Controllers\EncadrantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail; 

Route::get('/test-email', function() {
    Mail::to('ton_email_reel@example.com')->send(new TestEmail());
    return 'Email envoyé !';
});
// admin 
Route::middleware(['auth'])->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/utilisateurs', [AdminController::class, 'utilisateurs'])->name('admin.users');

        Route::delete('/admin/utilisateurs/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
Route::post('/admin/valider-rapport/{id}', [AdminController::class, 'validerRapport'])->name('admin.valider.rapport');
Route::post('/admin/refuser-rapport/{id}', [AdminController::class, 'refuserRapport'])->name('admin.refuser.rapport');
Route::post('/admin/valider-projet/{id}', [AdminController::class, 'validerProjet'])->name('admin.valider.projet');
Route::post('/admin/refuser-projet/{id}', [AdminController::class, 'refuserProjet'])->name('admin.refuser.projet');
Route::get('admin/etudiants/export', [AdminController::class, 'exportEtudiantsExcel'])->name('admin.etudiants.export');


Route::middleware(['auth'])->group(function () {
    Route::get('/etudiant/documents', [EtudiantController::class, 'documents'])->name('etudiant.documents');
});

  Route::get('/test-conv', function () {
    return 'La route fonctionne';
});
Route::get('/encadrant/conversations', function () {
    return 'test ok';
});


    Route::get('/etudiant/dashboard', function () {
    return view('etudiant.dashboard');
})->name('etudiant.dashboard')->middleware('auth');
// Pages pour Stage et PFE
    Route::get('/etudiant/stage', function () {
        return view('etudiant.stage.indexstage');
    })->name('etudiant.stage.indexstage');

    Route::get('/etudiant/pfe', function () {
        return view('etudiant.pfe.indexpfe');
    })->name('etudiant.pfe.indexpfe');



Route::get('/etudiants/{id}/rapport', function ($id) {
    $etudiant = \App\Models\Etudiant::findOrFail($id);

    if (!$etudiant->rapport) {
        abort(404, 'Aucun rapport trouvé.');
    }

    $path = storage_path('app/public/' . $etudiant->rapport);

    if (!file_exists($path)) {
        abort(404, 'Fichier non trouvé.');
    }

    // Pour voir dans le navigateur :
    return request()->has('download') 
    ? response()->download($path) 
    : response()->file($path);

    // Si tu veux FORCER le téléchargement :
    // return response()->download($path);
})->name('etudiants.rapport');

Route::get('/etudiant/documents', function () {
    return view('etudiant.documents');
})->name('etudiants.documents');
Route::get('/etudiant/stage', [EtudiantController::class, 'stage'])->name('etudiant.stage.indexstage');
Route::post('/etudiant/stage/store', [EtudiantController::class, 'storeRapportStage'])->name('etudiant.stage.store');
Route::post('/etudiant/stage/rapport', [EtudiantController::class, 'storeRapportStage'])->name('etudiant.stage.store');
// Route::get('/etudiant/stage/informations', [EtudiantController::class, 'editStageInfo'])->name('etudiant.stage.edit');
// Route::put('/etudiant/stage/informations', [EtudiantController::class, 'updateStageInfo'])->name('etudiant.stage.updateInfo');
 Route::get('/etudiant/stage/edit', [EtudiantController::class, 'editStageInfo'])->name('etudiant.stage.edit');
    Route::put('/etudiant/stage/update', [EtudiantController::class, 'updateStageInfo'])->name('etudiant.stage.updateInfo');
Route::get('/etudiant/pfe', [EtudiantController::class, 'pfe'])->name('etudiant.pfe.indexpfe');
Route::post('/etudiant/pfe/rapport', [EtudiantController::class, 'storePfe'])->name('etudiant.pfe.store');
Route::get('/etudiant/pfe/edit', [EtudiantController::class, 'editPfeInfo'])->name('etudiant.pfe.edit');
Route::put('/etudiant/pfe/update', [EtudiantController::class, 'updatePfeInfo'])->name('etudiant.pfe.updateInfo');



    // Étudiant : création de profil (supprimé le middleware 'role')
Route::get('/etudiant/profile/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiant/profile', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiant/profil', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::get('/etudiant/profil/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::get('/etudiants/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');

Route::put('/etudiant/profil', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiant/profil', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');



    // Profile (généré par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    // Éncadrant
   
Route::middleware(['auth'])->group(function () {
Route::get('/encadrant/create', [EncadrantController::class, 'create'])->name('encadrant.create');
Route::post('/encadrant', [EncadrantController::class, 'store'])->name('encadrant.store');
Route::get('/encadrant/dashboard', [EncadrantController::class, 'dashboard'])->name('encadrant.dashboard');
Route::put('/encadrant/dates', [EncadrantController::class, 'updateDates'])->name('encadrant.dates.update');

    
    Route::post('/encadrant/valider/{id}', [EncadrantController::class, 'validerRapport'])->name('encadrant.valider');
    Route::post('/encadrant/refuser/{id}', [EncadrantController::class, 'refuserRapport'])->name('encadrant.refuser');
    Route::put('/encadrants/update-statut/{etudiant}', [EncadrantController::class, 'updateStatut'])->name('encadrants.updateStatut');
Route::post('/etudiant/presentation', [EtudiantController::class, 'uploadPresentation'])->name('etudiant.presentation.upload');
Route::put('/encadrant/etudiant/{id}/valider-rapport', [EncadrantController::class, 'validerPre'])
    ->name('encadrant.rapport.validation');
    Route::put('/encadrants/{id}/statut-rapport', [EncadrantController::class, 'updateStatutRapport'])->name('encadrants.updateStatutRapport');
Route::put('/encadrants/{id}/statut-presentation', [EncadrantController::class, 'updateStatutPresentation'])->name('encadrants.updateStatutPresentation');
Route::get('/etudiant/notifications/lire', [EtudiantController::class, 'marquerNotificationsLues'])->name('etudiant.notifications.lire');
Route::put('/encadrant/commentaire-rapport/{etudiant}', [EncadrantController::class, 'updateCommentaireRapport'])->name('encadrants.updateCommentaireRapport');
Route::put('/encadrant/commentaire-presentation/{etudiant}', [EncadrantController::class, 'updateCommentairePresentation'])->name('encadrants.updateCommentairePresentation');

});


Route::get('/etudiant/historique-commentaires', [EtudiantController::class, 'historiqueCommentaires'])->name('etudiant.historique_commentaires');

Route::post('/etudiant/envoyer-message', [MessageController::class, 'envoyer'])->name('etudiant.message.envoyer');

Route::get('/encadrant/messages', [MessageController::class, 'boite'])->name('encadrant.messages');

Route::post('/encadrant/repondre/{id}', [MessageController::class, 'repondre'])->name('encadrant.message.repondre');
Route::get('/etudiant/historique-messages', function () {
    $etudiant = \App\Models\Etudiant::where('user_id', auth()->id())->firstOrFail();
    $messages = $etudiant->messages()->latest()->get();

    return view('etudiant.historique_messages', compact('messages'));
})->name('etudiant.historique_messages');
Route::get('/etudiant/contact', function () {
    $etudiant = Etudiant::where('user_id', auth()->id())->firstOrFail();
    return view('etudiant.contact', compact('etudiant'));
})->name('etudiant.contact');


Route::get('/encadrant/{id}', [EncadrantController::class, 'show'])->name('encadrant.show');
 Route::get('/encadrant/{id}/edit', [EncadrantController::class, 'edit'])->name('encadrant.edit');
    Route::put('/encadrant/{id}', [EncadrantController::class, 'update'])->name('encadrant.update');


Route::middleware('auth')->group(function () {
    Route::get('/etudiant/chat', [ConversationController::class, 'etudiantChat'])->name('etudiant.chat');
    Route::post('/etudiant/chat/{conversation}', [ConversationController::class, 'sendMessage'])->name('etudiant.chat.send');

    Route::get('/encadrant/conversations', [ConversationController::class, 'encadrantConversations'])->name('encadrant.conversations');
    Route::get('/encadrant/chat/{id}', [ConversationController::class, 'encadrantChat'])->name('encadrant.chat');
    Route::post('/encadrant/chat/{id}', [ConversationController::class, 'sendMessage'])->name('encadrant.chat.send');
});

Route::get('/home', function () {
    return view('auth.login');
})->name('home');

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('etudiant.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
