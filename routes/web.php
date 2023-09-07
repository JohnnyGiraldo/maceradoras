<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MaceradoraController;


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
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('clientes', ClienteController::class);
    Route::resource('maceradoras', MaceradoraController::class);
    Route::get('graphic',[MaceradoraController::class,'MaceradoraByCliente'])->name('graphic');
    Route::get('reports',[MaceradoraController::class,'reports'])->name('reports');
    Route::put('/maceradoras/{maceradora}', [MaceradoraController::class, 'update'])->name('maceradoras.update');
    Route::get('/maceradoras', [MaceradoraController::class, 'index'])->name('maceradoras.index');
    Route::get('/clientes/{id}/has-maceradora', 'ClienteController@hasMaceradora');
    
});
use App\Models\User;
Route::get('/notificacion', function (){
        $user = User::find(1);
        $user->notify(new \App\Notifications\InvoicePaid);

        return 'Notificacion Enviada';
});

require __DIR__.'/auth.php';
