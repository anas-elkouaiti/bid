<?php

namespace App\Http\Controllers;

use App\Models\Offerta;
use App\Models\Prodotto;
use App\Models\Utente;
use Illuminate\Http\Request;

class OffertaController extends Controller
{
    public function store(Request $request)
    {
        $utente = Utente::find($_SESSION['id_utente']);
        $prodotto = Prodotto::find($request->prodotto);

        $messaggio = "";

        if(!$prodotto->scaduto()){
            if(count($prodotto->offerte) == 0){
                $prezzo_offerta = (float) str_replace(",", "", $request->prezzo);

                $offerta = new Offerta();
                $offerta->utente_id = $utente->id;
                $offerta->prodotto_id = $prodotto->id;
                $offerta->prezzo = (double) str_replace(",", "", $request->prezzo);
                $offerta->stato = 'piu_alta';
                $offerta->data_esecuzione = date('Y-m-d H:i:s');
                $offerta->save();
                
                // update del bilancio
                $utente->update([
                    'bilancio' => $utente->bilancio - $prezzo_offerta
                ]);
                $_SESSION['utente'] = $utente;

                $messaggio = "Offerta eseguita correttamente";
            }else{
                $prezzo_offerta = (float) str_replace(",", "", $request->prezzo);
                $offerta_alta = $prodotto->offerta_alta_obj();
                $prezzo_offerta_alta = (double) $prodotto->offerta_alta();

                if($prezzo_offerta >= $prezzo_offerta_alta && $utente->id != $offerta_alta->utente_id){
                    $offerte_precedenti = $prodotto->offerte;
                    $offerte_precedenti->each(function($offerta){
                        $offerta->update([
                            'stato' => 'superata'
                        ]);
                        //update bilancio
                        $offerta->esecutore->update([
                            'bilancio' => $offerta->esecutore->bilancio + $offerta->prezzo
                        ]);
                    });

                    $offerta = new Offerta();
                    $offerta->utente_id = $utente->id;
                    $offerta->prodotto_id = $prodotto->id;
                    $offerta->prezzo = $prezzo_offerta;
                    $offerta->stato = 'piu_alta';
                    $offerta->data_esecuzione = date('Y-m-d H:i:s');
                    $offerta->save();

                    //update bilancio
                    $utente->update([
                        'bilancio' => $utente->bilancio - $prezzo_offerta
                    ]);
                    $_SESSION['utente'] = $utente;

                    $messaggio = "Offerta eseguita correttamente";
                }else{
                    $messaggio = "Errore nell'esecuzione dell'offerta";
                }
            }
        }else{
            $messaggio = "Il prodotto è scaduto";
        }

        $prodotti_consigliati = "";
        if(isset($_SESSION['logged']) && $_SESSION['logged']){
            $prodotti_consigliati = Prodotto::all()->filter(
                function($prodotto){
                    return $prodotto->venditore_id != $_SESSION['id_utente'];
                }
            )->random(2);
        }else{
            $prodotti_consigliati = Prodotto::all()->random(2);
        }
        $prodotto = Prodotto::find($request->prodotto);

        return view('product.show', [
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false,
            'id_utente' => isset($_SESSION['id_utente']) ? $_SESSION['id_utente'] : false,
            'messaggio' => $messaggio,
            'prodotto' => $prodotto,
            'prodotti_consigliati' => $prodotti_consigliati
        ]);
    }
}
