<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = [
        'etudiant_id',
        'encadrant_id',
        'contenu',
        'reponse',
    ];
    public function etudiant()
{
    return $this->belongsTo(Etudiant::class);
}

public function encadrant()
{
    return $this->belongsTo(Encadrant::class);
}
}
