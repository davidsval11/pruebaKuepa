<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/Registro', [EstudianteController::class, 'create']);
Route::post('/Estudiante', [EstudianteController::class, 'store'])->name("estudiante.store");
Route::put('/Estudiante', [EstudianteController::class, 'update'])->name("estudiante.update");
Route::get('/Estudiante', [EstudianteController::class, 'index'])->name("estudiante.index");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
