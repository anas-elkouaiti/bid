<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    protected $table = 'prodotto';
    public $timestamps = false;
    protected $fillable = [
        'venditore_id', 'titolo', 'descrizione', 'location', 'base_asta', 'data_caricamento', 'data_scadenza'
    ];

    public function categorie(){
        return $this->belongsToMany(Categoria::class, 'categoria_prodotto');
    }

    public function offerte(){
        return $this->hasMany(Offerta::class, 'prodotto_id')->orderBy('prezzo', 'desc');
    }

    public function venditore(){
        return $this->belongsTo(Utente::class, 'venditore_id');
    }

    public function offerta_alta(){
        return isset($this->hasMany(Offerta::class, 'prodotto_id')->orderBy('prezzo', 'desc')->first()->prezzo) ? 
                    $this->hasMany(Offerta::class, 'prodotto_id')->orderBy('prezzo', 'desc')->first()->prezzo : 
                    $this->base_asta;
    }

    public function offerta_alta_obj(){
        return $this->hasMany(Offerta::class, 'prodotto_id')->orderBy('prezzo', 'desc')->first();
    }

    public function scaduto(){
        $data_odierna = date('Y-m-d H:i');

        return $data_odierna > date('Y-m-d H:i', strtotime($this->data_scadenza));
    }

    public function cancellabile(){
        $data_odierna = date('Y-m-d H:i');

        return $data_odierna < date('Y-m-d H:i', strtotime($this->data_scadenza . ' - 1 day'));
    }

    public function immagini(){
        return $this->hasMany(Immagine::class, 'prodotto_id');
    }

    public function titolo_croppato(){
        return strlen($this->titolo) > 27 ? substr($this->titolo, 0, 27) . "..." : $this->titolo;
    }

    use HasFactory;
}
