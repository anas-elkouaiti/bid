<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['lang'])->group(function(){
    Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('home');
    Route::get('/contattaci', [\App\Http\Controllers\FrontController::class, 'contattaci'])->name('contattaci');
    Route::post('/contattaci', [\App\Http\Controllers\FrontController::class, 'invia_mail'])->name('contattaci');

    Route::get('/prodotti', [\App\Http\Controllers\ProdottoController::class, 'index'])->name('prodotti.index');
    Route::get('/prodotti/dettaglio/{prodotto}', [\App\Http\Controllers\ProdottoController::class, 'show'])->name('prodotti.show');
    Route::post('/prodotti/cerca', [\App\Http\Controllers\ProdottoController::class, 'search'])->name('prodotti.search');
    Route::get('/prodotti/dettaglio/{prodotto}/scaduto', [\App\Http\Controllers\ProdottoController::class, 'scaduto'])->name('prodotti.scaduto');

    Route::get('/user/login', [\App\Http\Controllers\AuthController::class, 'authentication'])->name('user.login');
    Route::get('/user/signup', [\App\Http\Controllers\AuthController::class, 'registration'])->name('user.signup');
    Route::post('/user/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('user.login');
    Route::post('/user/signup', [\App\Http\Controllers\AuthController::class, 'signup'])->name('user.signup');
    Route::get('/user/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('user.logout');
    Route::post('/user/checkEmail', [\App\Http\Controllers\AuthController::class, 'checkEmail'])->name('user.checkEmail');
    
    Route::get('/lang/{lang}', [\App\Http\Controllers\FrontController::class, 'changeLanguage'])->name('setLang');
});

Route::middleware(['lang', 'usersession'])->group(function(){
    Route::get('/prodotti/create', [\App\Http\Controllers\ProdottoController::class, 'create'])->name('prodotti.create');
    Route::post('/prodotti/create', [\App\Http\Controllers\ProdottoController::class, 'store'])->name('prodotti.create');
    Route::post('/prodotti/dettaglio/{prodotto}', [\App\Http\Controllers\OffertaController::class, 'store'])->name('prodotti.offerta');
    Route::delete('/prodotti/dettaglio/{prodotto}/delete', [\App\Http\Controllers\ProdottoController::class, 'destroy'])->name('prodotti.destroy');

    Route::get('/user/dashboard', [\App\Http\Controllers\AuthController::class, 'dashboard'])->name('user.dashboard');
    Route::put('/user/dashboard', [\App\Http\Controllers\AuthController::class, 'update'])->name('user.update');
    Route::get('/user/dashboard/updateBudget', [\App\Http\Controllers\UtenteController::class, 'updateBudget'])->name('user.updateBudget');
    Route::post('/user/verifyBudget', [\App\Http\Controllers\UtenteController::class, 'verifyBudget'])->name('user.verifyBudget');
});

