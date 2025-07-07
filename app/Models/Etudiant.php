<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
    'filiere',
    'niveau',
    'telephone',
    'email',
    'etablissement',
    'photo',
    'user_id',
    'statut_validation',
    'presentation',
     'statut_rapport'
];
    public function user()
{
    return $this->belongsTo(User::class);
}
   public function encadrant()
{
    return $this->belongsTo(Encadrant::class);
}
public function stage()
{
    return $this->hasOne(Stage::class);
}
public function modificationHistories()
{
    return $this->hasMany(ModificationHistory::class);
}
public function messages()
{
    return $this->hasMany(Message::class);
}
}

