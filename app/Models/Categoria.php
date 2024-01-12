<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    public $timestamps = false;
    protected $fillable = [
        'nome', 'icona'
    ];

    public function prodotti(){
        return $this->belongsToMany(Prodotto::class, 'categoria_prodotto');
    }

    use HasFactory;
}
