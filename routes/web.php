<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ExpenseController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');



require __DIR__.'/auth.php';
