<?php

use App\Http\Livewire\ArticuloComponent;
use App\Http\Livewire\ArticuloUserComponent;
use App\Http\Livewire\PedidoComponent;
use App\Http\Livewire\UserTable;
use App\Models\ArticuloUser;
use App\Models\User;
use App\Models\Pedido;
use App\View\Components\AppLayout;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('User', UserTable::class)->name('user');
Route::get('Pedidos', PedidoComponent::class)->name('pedidos');
Route::get('Articulos', ArticuloComponent::class)->name('articulos');
Route::get('ArticulosUser', ArticuloUserComponent::class)->name('articulosUser');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
