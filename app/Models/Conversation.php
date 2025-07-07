<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['etudiant_id', 'encadrant_id'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function encadrant()
    {
        return $this->belongsTo(Encadrant::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
