<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Prodotto;
use App\Models\Categoria;
use App\Models\Utente;
use App\Models\Offerta;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;


class FrontController extends Controller
{
    public function index(){
        session_start();

        $categorie = Categoria::all();
        $prodotti = Prodotto::all()->sortByDesc('data_scadenza')->take(6);
        
        if(isset($_SESSION['logged']) && $_SESSION['logged']){
            
            $prodotti = Prodotto::all()->sortByDesc('data_scadenza')->filter(
                function($prodotto){
                    return $prodotto->id_venditore != $_SESSION['id_utente'];
                }
            )->take(6);
            
            return view('home.index', [
                'categorie' => $categorie,
                'prodotti' => $prodotti,
                'utente' => Utente::find($_SESSION['id_utente']),
                'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false
            ]);
        }else{
            $prodotti = Prodotto::all()->sortByDesc('data_scadenza')->take(6);

            return view('home.index', [
                'categorie' => $categorie,
                'prodotti' => $prodotti,
                'utente' => false
            ]);
        }   
    }

    public function contattaci(Request $request){
        session_start();

        $agent = new Agent();

        return view('home.contact', [
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false,
            'nome_utente' => isset($_SESSION['nominativo']) ? $_SESSION['nominativo'] : "",
            'email_utente' => isset($_SESSION['email']) ? $_SESSION['email'] : "",
            'isChrome' => $agent->is('Chrome')
        ]);
    }

    public function invia_mail(Request $request){
        session_start();

        Mail::to("info@bid.com")->send(new TestMail($request->nome, $request->email, $request->oggetto, $request->messaggio));

        $agent = new Agent();

        return view('home.contact', [
            'logged' => isset($_SESSION['logged']) ? $_SESSION['logged'] : false,
            'nome_utente' => isset($_SESSION['nominativo']) ? $_SESSION['nominativo'] : "",
            'email_utente' => isset($_SESSION['email']) ? $_SESSION['email'] : "",
            'messaggio_inviato' => true,
            'isChrome' => $agent->is('Chrome')
        ]);
    }

    public function changeLanguage(Request $request, $language)
    {
        session_start();
        
        Session::put('language', $language);
        return redirect()->back();
    }
}

