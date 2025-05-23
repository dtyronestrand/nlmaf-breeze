<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NewsController;
use Inertia\Inertia;


  Route::get('/', PageHomeController::class)->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('profile', ProfileController::class)->only('show','edit','update')
->middleware('auth')->names([
    'show' => 'profile.show',
    'edit' => 'profile.edit',
    'update' => 'profile.update',
]);

require __DIR__.'/auth.php';
Route::get('/news', [NewsController::class, 'index']);
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/programs/taekwondo/members', function () {
    return Inertia::render('Programs/Taekwondo/Members');
})->middleware('auth')->name('programs.taekwondo.members');

    Route::get('/programs/{slug}', [ProgramController::class, 'show'])
->where('slug','.*')
    ->name('program.show');
Route::get('/{slug}', [PageController::class, 'show'])
->where('slug','.*')
    ->name('page.show');
