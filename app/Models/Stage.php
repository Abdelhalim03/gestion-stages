<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'etudiant_id',
        'encadrant_id',
    ];

    // 👉 ICI LES RELATIONS

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }

    public function encadrant()
    {
        return $this->belongsTo(User::class, 'encadrant_id');
    }

    public function rapport()
    {
        return $this->hasOne(Rapport::class);
    }

    public function soutenance()
    {
        return $this->hasOne(Soutenance::class);
    }
}
