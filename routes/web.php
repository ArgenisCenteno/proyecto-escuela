<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\NotaMedicaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PacienteTratamientoController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\TratamientoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('especialistas', EspecialistaController::class);
    Route::resource('citas', CitaController::class);
    Route::resource('tratamientos', TratamientoController::class);
    Route::resource('notasmedicas', NotaMedicaController::class);
    Route::resource('pacienteTratamientos', PacienteTratamientoController::class);
    Route::post('/reportes/citas/export', [CitaController::class, 'export'])->name('citas.export');
    Route::post('/paciente-tratamientos/export', [PacienteTratamientoController::class, 'export'])->name('pacienteTratamientos.export');
    Route::get('/pacientes/export', [PacienteController::class, 'export'])->name('pacientes.export');
    Route::get('/pdf/{id}', [PacienteController::class, 'pdf'])->name('pacientes.pdf');

    Route::resource('pacientes', PacienteController::class);
    Route::resource('representantes', RepresentanteController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
