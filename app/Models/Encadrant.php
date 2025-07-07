<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadrant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialite',
        'telephone',
        'email',
        'date_limite_rapport',
        'date_soutenance'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
   public function etudiants()
{
    return $this->hasMany(Etudiant::class);
}
public function messages()
{
    return $this->hasMany(Message::class);
}
}
