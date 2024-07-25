<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DompetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PencatatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Kategori;
use App\Models\Category;

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
    $categories = Category::all();
    return view('dashboard' , ['categories' => $categories]);
})->name('dashboard')->middleware('auth');

Route::post('/inputDompet', [DompetController::class, 'inputDompet'])->name('input_dompet');
Route::post('/editDompet', [DompetController::class, 'editDompet'])->name('edit_dompet');


//test
Route::get('/testingaja', function(){return view('popup_Transaksi');});
Route::post('/inputTx', [TransactionController::class, 'inputTransaction'])->name('input_transaction');

Route::get('/pencatatan', [PencatatanController::class, 'index'])->name('pencatatan');
Route::post('/pencatatan', [PencatatanController::class, 'fetchData'])->name('pencatatan.data');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::get('/AnggaranAktif' , function(){
    $categories = Category::all();
    return view('AnggaranAktif' , ['categories' => $categories]);
})->name('AnggaranAktif');
Route::get('/AnggaranTidakAKtif' , function(){
    $categories = Category::all();
    return view('AnggaranNonAktif' , ['categories' => $categories]);
})->name('AnggaranTidakAKtif');