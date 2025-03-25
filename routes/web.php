<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;

// Redirection page accueil
Route::get('/', [CalculatorController::class, 'accueil']);

// Routes calcul
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculator.calculate');
