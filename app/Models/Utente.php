<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    protected $table = 'utente';
    public $timestamps = false;
    protected $fillable = [
        'email', 'username', 'password', 'paese', 'indirizzo', 'nome', 'cognome', 'img_profilo', 'bilancio'
    ];

    public function offerte(){
        return $this->hasMany(Offerta::class, 'utente_id');
    }

    public function inserzioni(){
        return $this->hasMany(Prodotto::class, 'venditore_id');
    }

    public function offerte_aggiudicate(){
        return $this->hasMany(Offerta::class, 'utente_id')->where('stato', 'aggiudicato');
    }

    use HasFactory;
}
