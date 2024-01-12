<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Utente;
use App\Models\DataLayer;

class AuthController extends Controller
{
    public function authentication(){
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'])
            return redirect()->route('home');

        return view('auth.login');
    }

    public function registration(){
        session_start();
        if(isset($_SESSION['logged']) && $_SESSION['logged'])
            return redirect()->route('home');

        return view('auth.signup');
    }

    public function login(Request $request){
        session_start();

        $dl = new DataLayer();
        $utente = $dl->verificaUtente($request->email, md5($request->password));
        $_SESSION['logged'] = $utente !== null;
        
        if($_SESSION['logged']){
            $_SESSION['id_utente'] = $utente->id;
            $_SESSION['utente'] = $utente;
            $_SESSION['email'] = $utente->email;
            $_SESSION['username'] = $utente->username;
            $_SESSION['nominativo'] = ucwords($utente->cognome . " " . $utente->nome);

            return Redirect::to(route('home'));
        }else{
            return view('auth.login', [
                'logged' => $_SESSION['logged']
            ]);
        }
    }

    public function signup(Request $request){
        $dl = new DataLayer();
        $dl->creaUtente($request->email, $request->username, $request->password, $request->nome, $request->cognome, $request->img_profilo);

        return Redirect::to(route('user.login'));
    }

    public function logout(Request $request){
        session_start();
        session_destroy();
        
        return Redirect::to(route('home'));
    }

    public function checkEmail(Request $request){
        $utente_email = Utente::where('email', $request->email)->first();

        return $utente_email === null;
    }

    public function dashboard(){
        $utente = Utente::find($_SESSION['id_utente']);

        return view('auth.dashboard', [
            'logged' => $_SESSION['logged'],
            'utente' => $utente
        ]);
    }

    public function update(Request $request){
        $utente = Utente::find($_SESSION['id_utente']);

        $messaggio = "";

        if($request->vecchia_password == ""){
            $utente->update([
                'nome' => $request->nome,
                'cognome' => $request->cognome,
                'email' => $request->email,
                'paese' => !empty($request->paese) ? $request->paese : "",
                'indirizzo' => !empty($request->indirizzo) ? $request->indirizzo : ""
            ]);
            $messaggio = "Update delle informazioni avvenuto correttamente!";
        }else{
            if($utente->password != md5($request->vecchia_password)){
                $messaggio = "Errore nell'update delle informazioni!";
            }else{
                $utente->update([
                    'nome' => $request->nome,
                    'cognome' => $request->cognome,
                    'email' => $request->email,
                    'paese' => !empty($request->paese) ? $request->paese : "",
                    'indirizzo' => !empty($request->indirizzo) ? $request->indirizzo : "",
                    'password' => md5($request->nuova_password)
                ]);
                $messaggio = "Update delle informazioni avvenuto correttamente!";
            }
        }

        return view('auth.dashboard', [
            'logged' => $_SESSION['logged'],
            'utente' => $utente,
            'messaggio' => $messaggio
        ]);
            
    }
}
