<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utente;
use App\Models\Prodotto;

class DataLayer extends Model
{
    public function creaUtente($email, $username, $password, $nome, $cognome, $img_profilo){
        $utente = new Utente();
        $utente->email = $email;
        $utente->username = $username;
        $utente->password = md5($password);
        $utente->paese = "";
        $utente->indirizzo = "";
        $utente->nome = ucwords(strtolower($nome));
        $utente->cognome = ucwords(strtolower($cognome));

        if(!empty($img_profilo)){
            $imageName = $username . "." . $img_profilo->getClientOriginalExtension();
            $img_profilo->move(public_path("/images/profile_pictures"), $imageName);
            $utente->img_profilo = "/images/profile_pictures/" . $imageName;
        }else{
            $utente->img_profilo = "/images/profile_pictures/pro-pic.png";
        }

        $utente->bilancio = 10000.00;
        $utente->save();
    }

    public function verificaUtente($email, $password){
        return Utente::where('email', $email)->where('password', $password)->first();
    }

    public function filtraProdotti($input, $page, $categoria, $ordinamento, $includi){
        if(empty($input) || (count($input)==1 && isset($page)) || (empty($categoria) && empty($ordinamento) && empty($includi))){
            $prodotti = Prodotto::where('prodotto.data_scadenza', '>', date('Y-m-d H:i:s'));
            $prodotti = $prodotti->paginate(18);
        }else{
            $prodotti = "";
            if(isset($categoria) && !empty($categoria)){
                $prodotti = Prodotto::join('categoria_prodotto', 'categoria_prodotto.prodotto_id', '=', 'prodotto.id')
                            ->where('categoria_prodotto.categoria_id', $categoria)
                            ->select('prodotto.*');
            }else{
                $prodotti = "";
            }
            if(isset($ordinamento) && !empty($ordinamento)){
                if($ordinamento == "prezzo"){
                    if($prodotti == "") $prodotti = Prodotto::orderBy('base_asta', 'asc');
                    else $prodotti = $prodotti->orderBy('base_asta', 'asc');
                }
                else if($ordinamento == "data"){
                    if($prodotti == "") $prodotti = Prodotto::orderBy('data_scadenza', 'asc');
                    else $prodotti = $prodotti->orderBy('data_scadenza', 'asc');
                }
            }

            if(!isset($includi) || empty($includi) || $includi != "scad"){
                if($prodotti == "") $prodotti = Prodotto::where('prodotto.data_scadenza', '>', date('Y-m-d H:i:s'));
                else $prodotti = $prodotti->where('prodotto.data_scadenza', '>', date('Y-m-d H:i:s'));
            }
            if($prodotti=="") $prodotti = Prodotto::paginate(18);
            else $prodotti = $prodotti->paginate(18);
        }
        return $prodotti;
    }

    use HasFactory;
}
