<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immagine extends Model
{
    protected $table = 'immagine';
    protected $fillable = ['prodotto_id', 'percorso'];
    public $timestamps = false;

    use HasFactory;

    public function prodotto(){
        return $this->belongsTo(Prodotto::class, 'prodotto_id');
    }
}
