<?php

use App\Http\Livewire\ArticuloComponent;
use App\Http\Livewire\ArticuloUserComponent;
use App\Http\Livewire\GestionPedidosComponent;
use App\Http\Livewire\PedidoComponent;
use App\Http\Livewire\UserTable;
use App\Http\Livewire\ImportComponent;
use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    return view('auth.login2');
});
Route::get('User', UserTable::class)->name('user');
Route::get('GestionPedidos', GestionPedidosComponent::class)->name('gestionPedidos');
Route::get('Pedidos', PedidoComponent::class)->name('pedidos');
Route::get('Articulos', ArticuloComponent::class)->name('articulos');
Route::get('ArticulosUser', ArticuloUserComponent::class)->name('articulosUser');
Route::get('articulosUserPdf', [ArticuloUserComponent::class, 'makePDF'])->name('articulosUserPdf');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('ImportArt', [ImportComponent::class,'getImportArt'])->name('importArt');
Route::post('ImportArt_parse', [ImportComponent::class,'parseImportArt'])->name('importArt_parse');
Route::get('ImportArtUsr', [ImportComponent::class,'getImportArtUsr'])->name('importArtUsr');
Route::post('ImportArtUsr_parse', [ImportComponent::class,'parseImportArtUsr'])->name('importArtUsr_parse');
