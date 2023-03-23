<?php

use App\Http\Controllers\EnvioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TransportadoraController;
use App\Models\Envio;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION
    ]);
})->name('welcome');
Route::resource('/pedido', PedidoController::class )->names('pedidos');
Route::resource('/envio', EnvioController::class)->names('envio');
Route::resource('/transportadora', TransportadoraController::class)->names('transportadora');
Route::post('/search', function (Request $request) {
    $envio = Envio::where('NumeroPedido', $request['code'])->first();
    return response()->json($envio);
    return redirect()->route('welcome', [
        'envio' => $envio
    ])->with('success', 'Se ha actualizado la información');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
