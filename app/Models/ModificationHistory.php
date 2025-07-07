<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModificationHistory extends Model
{
    protected $fillable = [
        'etudiant_id',
        'type',
        'ancien_statut',
        'nouveau_statut',
        'commentaire',
        'updated_by',
    ];
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function encadrant()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
   


}
