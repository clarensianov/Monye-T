<?php

use App\Http\Controllers\DompetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PencatatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::redirect('/home','/dashboard')->name('dashboard')->middleware('auth');



Route::get('/login', [UserController::class, 'loginindex'])->name('loginregister')->middleware('guest');
Route::get('/register', [UserController::class, 'registerindex'])->name('register')->middleware('guest');

Route::post('/loginregister/login   ', [UserController::class, 'login']);
Route::post('/loginregister/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);

//tes
Route::get('/logout1', [UserController::class, 'logout']);

Route::get('/loginregister/register/katapemulihan', function (){return view('katapemulihan');})->name('katapemulihan')->middleware('auth');
Route::put('/loginregister/register/katapemulihan/{id}', [UserController::class, 'katapemulihan'])->name('create_katapemulihan');

Route::get('/lupasandi', function (){ return view('lupasandi');})->name('lupasandi');
Route::post('/lupasandi',[UserController::class, 'lupasandi']);

Route::get('/inputsandi' , function (){ return view('inputsandibaru');})->name('inputsandi');
Route::put('/inputsandi/{id}', [UserController::class, 'inputsandi'])->name('change_password');


Route::get('/dashboard', function(){
    // Take all user's dompet (function found in user model)
    // $dompets = Auth::user()->dompets;
    // dd($dompets);

    // return view('dashboard', compact('dompets'));
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::post('/inputDompet', [DompetController::class, 'inputDompet'])->name('input_dompet');
Route::post('/editDompet', [DompetController::class, 'editDompet'])->name('edit_dompet');


//test
Route::get('/testingaja', function(){return view('popup_Transaksi');});
Route::post('/inputTx', [TransactionController::class, 'inputTransaction'])->name('input_transaction');

Route::get('/pencatatan', [PencatatanController::class, 'index'])->name('pencatatan');
Route::post('/pencatatan', [PencatatanController::class, 'fetchData'])->name('pencatatan.data');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


