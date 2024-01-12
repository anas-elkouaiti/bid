<?php

namespace App\Http\Controllers;

use App\Models\Utente;
use Illuminate\Http\Request;

class UtenteController extends Controller
{
    
    public function verifyBudget(Request $request)
    {
        $offerta = floatval($request->offerta);
        $utente = Utente::find($request->id_utente);
        $budget = floatval($utente->bilancio);

        return $offerta<=$budget;
    }

    public function updateBudget()
    {
        $utente = Utente::find($_SESSION['id_utente']);

        $utente->update([
            'bilancio' => $utente->bilancio + 5000
        ]);

        $_SESSION['utente'] = $utente;

        return redirect()->route('user.dashboard');
    }

}
