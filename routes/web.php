<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SavingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ExpenseController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

Route::get('/recurring', function () {
    return view('recurring');
})->name('recurring');

Route::get('/goals', [SavingController::class, 'index'])->name('goals.index');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');


Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');

// Route for storing saving goals
Route::post('/saving-goals', [SavingController::class, 'store'])->name('saving-goals.store');
Route::put('/saving-goals/{id}', [SavingController::class, 'update'])->name('saving-goals.update');
Route::post('/saving-goals/{id}/add-extra-contribution', [SavingController::class, 'addExtraContribution'])->name('saving-goals.add-extra-contribution');


require __DIR__.'/auth.php';
