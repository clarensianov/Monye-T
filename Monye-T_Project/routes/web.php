<?php

use App\Http\Controllers\UserController;
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
Route::redirect('/', '/login');
Route::redirect('/home','/dashboard');

Route::get('/login', [UserController::class, 'loginindex'])->name('loginregister')->middleware('guest');
Route::get('/register', [UserController::class, 'registerindex'])->name('register')->middleware('guest');

Route::post('/loginregister/login   ', [UserController::class, 'login']);
Route::post('/loginregister/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/loginregister/register/katapemulihan', function (){return view('katapemulihan');})->name('katapemulihan')->middleware('auth');    
Route::put('/loginregister/register/katapemulihan/{id}', [UserController::class, 'katapemulihan'])->name('create_katapemulihan');

Route::get('/lupasandi', function (){ return view('lupasandi');})->name('lupasandi');
Route::post('/lupasandi',[UserController::class, 'lupasandi']);

Route::get('/inputsandi' , function (){ return view('inputsandibaru');})->name('inputsandi');
Route::put('/inputsandi/{id}', [UserController::class, 'inputsandi'])->name('change_password');


Route::get('/dashboard', function(){ return view('dashboard');})->middleware('auth');
Route::get('/navbar', function(){ return view('components.navbar');});