<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\BookController;

// Routes accessibles aux utilisateurs authentifiés
Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
    Route::get('/books/reserve/{id}', [BookController::class, 'showReserveForm'])->name('books.reserve.form'); // Formulaire de réservation
    Route::post('/books/reserve/{id}', [BookController::class, 'reserve'])->name('books.reserve'); // Soumettre la réservation
});

// Routes protégées pour les administrateurs
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create'); // Formulaire d'ajout de livre
    Route::post('/books', [BookController::class, 'store'])->name('books.store'); // Ajouter un livre
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit'); // Formulaire d'édition de livre
    Route::patch('/books/{id}', [BookController::class, 'update'])->name('books.update'); // Mettre à jour un livre
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy'); // Supprimer un livre
});

// Route de bienvenue
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard pour les utilisateurs vérifiés
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour gérer le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/books/{id}/favorite', [BookController::class, 'toggleFavorite'])->name('books.favorite');

// Authentification Laravel Breeze
require __DIR__.'/auth.php';
