<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Models\Categoria;
use App\Models\DataLayer;
use App\Models\Offerta;
use App\Models\Immagine;
use Illuminate\Http\Request;

class ProdottoController extends Controller
{
    public function index(Request $request)
    {
        session_start();

        $categorie = Categoria::all();

        $dl = new DataLayer();
        $prodotti = $dl->filtraProdotti($request->input(), $request->page, $request->categoria, $request->ordinamento, $request->includi);

        return view('product.index', [
            'prodotti' => $prodotti,
            'categorie' => $categorie,
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false
        ]);
    }

    public function create()
    {
        $categorie = Categoria::all();

        return view('product.insert', [
            'categorie' => $categorie,
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false
        ]);
    }

    public function store(Request $request)
    {
        $prodotto = new Prodotto();
        $prodotto->venditore_id = $_SESSION['id_utente'];
        $prodotto->titolo = ucwords($request->titolo);
        $prodotto->descrizione = $request->descrizione;
        $prodotto->location = $request->location;
        $prodotto->base_asta = (double) str_replace(",", "", $request->base_asta);
        $prodotto->data_caricamento = date('Y-m-d H:i:s');
        $prodotto->data_scadenza = $request->data_scadenza;
        $prodotto->save();

        $categorie = explode(",", $request->categorie_selezionate[0]);
        $cat = array_shift($categorie);

        $prodotto->categorie()->attach($categorie);

        $count = 1;
        foreach($request->img_prodotto as $img){
            
            $imageName = $prodotto->id . "_" . $count . "." . $img->getClientOriginalExtension();
            $img->move(public_path("/images/product_pictures"), $imageName);

            $immagine = Immagine::create([
                'prodotto_id' => $prodotto->id,
                'percorso' => "/images/product_pictures/" . $imageName
            ]);
            $count++;
        }

        return redirect()->route('prodotti.index');

    }

    public function show(Prodotto $prodotto, Request $request)
    {
        session_start();

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
        
        return view('product.show', [
            'prodotto' => $prodotto,
            'prodotti_consigliati' => $prodotti_consigliati,
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false,
            'id_utente' => isset($_SESSION['id_utente']) ? $_SESSION['id_utente'] : 0
        ]);
    }

    public function scaduto(Request $request, Prodotto $prodotto)
    {
        session_start();
        
        $offerta_alta = $prodotto->offerta_alta_obj();

        $messaggio = "nessun aggiornamento per id_prod = " . $prodotto->id;

        //condizione da rimettere dopo che si toglie la factory
        //$offerta_alta !== NULL && $offerta_alta->stato != 'aggiudicato'
        if($offerta_alta !== NULL && $offerta_alta->stato != 'aggiudicato'){
            $offerte_perdenti = Offerta::where('id', '!=', $offerta_alta->id)
                                ->where('prodotto_id', $prodotto->id);
            
            $offerte_perdenti->each(function($offerta){
                $offerta->update([
                    'stato' => 'non_aggiudicato'
                ]);
            });

            $offerta_alta->update([
                'stato' => 'aggiudicato'
            ]);

            $utente = $prodotto->venditore;
            $utente->update([
                'bilancio' => $utente->bilancio + $offerta_alta->prezzo
            ]);

            $messaggio = "aggiornamento per id_prod = " . $prodotto->id;
        }

        return $messaggio;
    }

    public function destroy(Prodotto $prodotto)
    {
        $offerta_alta = $prodotto->offerta_alta_obj();
        if($offerta_alta != null){
            $utente = $offerta_alta->esecutore;

            $utente->update([
                'bilancio' => $utente->bilancio + $offerta_alta->prezzo
            ]);
        }
        Offerta::where('prodotto_id', $prodotto->id)->delete();
        $prodotto->delete();
        return redirect()->route('user.dashboard');
    }

    public function search(Request $request)
    {
        session_start();

        $prodotti = Prodotto::where('titolo', 'Like', '%'.strtolower($request->testo).'%')->get('*');

        return view('product.results', [
            'prodotti' => $prodotti,
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false,
            'testo' => $request->testo
        ]);
    }
}
