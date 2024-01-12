<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offerta extends Model
{
    protected $table = 'offerta';
    public $timestamps = false;
    protected $fillable = [
        'utente_id', 'prodotto_id', 'prezzo', 'stato', 'data_esecuzione'
    ];

    public function esecutore(){
        return $this->belongsTo(Utente::class, 'utente_id');
    }

    public function prodotto(){
        return $this->belongsTo(Prodotto::class, 'prodotto_id');
    }

    use HasFactory;
}
