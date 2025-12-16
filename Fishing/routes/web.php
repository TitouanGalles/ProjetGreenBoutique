<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BaitController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaiementController;

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

Route::get('/', [BaitController::class, 'index'])->name('home');

// Auth
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('connexion');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Panier
Route::get('/panier', [PanierController::class, 'afficher'])->name('panier');
Route::get('/ajoutPanier/{id}', [PanierController::class, 'ajouter'])->name('ajoutPanier');
Route::post('/suppPanier/{id}', [PanierController::class, 'retirer'])->name('suppPanier');
Route::get('/supPanier', [PanierController::class, 'vider'])->name('supPanier');

// Paiement
Route::get('/paiement', [PaiementController::class, 'show'])->name('paiement');
Route::post('/verifPaiement', [PaiementController::class, 'verify'])->name('verifPaiement');

Route::get('/', [BaitController::class, 'index']);

// Panier
Route::get('/panier', [PanierController::class, 'afficher']);
Route::post('/panier/add/{id}', [PanierController::class, 'ajouter']);
Route::post('/panier/remove/{id}', [PanierController::class, 'retirer']);
Route::post('/panier/vider', [PanierController::class, 'vider']);

// Back-office
Route::get('/backoffice', [BaitController::class, 'adminIndex']);
Route::get('/backoffice/create', [BaitController::class, 'create']);
Route::get('/backoffice/edit/{id}', [BaitController::class, 'edit']);
Route::post('/backoffice/delete/{id}', [BaitController::class, 'destroy']);