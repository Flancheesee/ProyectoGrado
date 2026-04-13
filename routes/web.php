<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
