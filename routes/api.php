<?php
use App\Http\Controllers\BuildController;
use Illuminate\Support\Facades\Route;

Route::get('/compatible-motherboards/{cpuId}', [BuildController::class, 'getCompatibleMotherboards']);
Route::get('/compatible-gpus/{cpuId}/{motherboardId}', [BuildController::class, 'getCompatibleGpus']);
Route::get('/compatible-rams/{motherboardId}', [BuildController::class, 'getCompatibleRams']);
Route::get('/compatible-storages/{ramId}', [BuildController::class, 'getCompatibleStorages']);
Route::get('/compatible-power-supplies/{storageId}', [BuildController::class, 'getCompatiblePowerSupplies']);
