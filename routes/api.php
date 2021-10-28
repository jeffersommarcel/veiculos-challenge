<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;


Route::get('get/veiculos', [CarsController::class, 'getVeiculos'])->name('get/veiculos');
Route::get('get/veiculo/{id}', [CarsController::class, 'getVeiculo'])->name('get/veiculo');
Route::post('register/veiculo', [CarsController::class, 'registerVeiculos'])->name('register/veiculo');
Route::put('update/veiculos/{id}', [CarsController::class, 'updateVeiculo'])->name('update/veiculo');
Route::delete('delete/veiculo/{id}', [CarsController::class, 'deleteVeiculo'])->name('delete/veiculo');
