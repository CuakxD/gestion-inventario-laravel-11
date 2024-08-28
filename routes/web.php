<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $itemsArray = (new ItemController)->allItems(); // Llama al método allItems del ItemController
    return view('dashboard', compact('itemsArray'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/items/all', [ItemController::class, 'allItems'])->name('items.all'); 
    Route::resource('items', ItemController::class);
});

require __DIR__.'/auth.php';
