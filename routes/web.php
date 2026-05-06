<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MudanzaController;

/* -- RUTAS DE BLADE --*/

Route::redirect('/', '/home');

Route::get('/home', function () {
    return view('index');
})-> name('home');

Route::get('envios', function (){
    return view('envios');
})-> name('envios');

Route::get('faq', function(){
    return view('faq');
})-> name('faq');

Route::get('review', function(){
    return view('review');
})-> name('review');

Route::get('support', function(){
    return view('support');
})-> name('support');

Route::get('/registro', function(){
    return view('registro');
})-> name('registro');

Route::get('/cuenta', function () {
    return view('cuenta');
})->name('cuenta')->middleware('auth');

Route::get('/work', function (){
    return view('trabajador');
})->name('trabajador');

/* -- RUTAS DE CONTROLADORES --*/
Route::post('/registro', [RegisterController::class, 'store'])->name('register.store');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout/cliente', [LoginController::class, 'logoutCliente'])->name('logout.cliente');
Route::post('/logout/trabajador', [LoginController::class, 'logoutTrabajador'])->name('logout.trabajador');
Route::post('/work/login', [LoginController::class, 'loginTrabajador'])->name('worklogin.post');

Route::get('/work/dashboard', [LoginController::class, 'showDashboard'])
    ->name('dashboard')
    ->middleware('auth:worker');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/mudanzas/store', [MudanzaController::class, 'store'])->name('mudanzas.store')->middleware('auth');

//require __DIR__.'/auth.php';