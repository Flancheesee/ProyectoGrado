<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/* -- RUTAS DE BLADE --*/

Route::redirect('/', '/home');

Route::get('/home', function () {
    return view('index');
})-> name('home');

Route::get('/about_us', function () {
    return view('about_us');
})-> name('about_us');

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

/* -- RUTAS DE CONTROLADORES --*/
Route::post('/registro', [RegisterController::class, 'store'])->name('register.store');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__.'/auth.php';
