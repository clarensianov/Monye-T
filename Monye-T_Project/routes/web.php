<?php

use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DompetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PencatatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Mail\DailyReminder;
use App\Mail\ReminderMail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Budget;

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
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

//tes
Route::get('/logout1', [UserController::class, 'logout'])->name('logout1');

Route::get('/loginregister/register/katapemulihan', function (){return view('katapemulihan');})->name('katapemulihan')->middleware('auth');
Route::put('/loginregister/register/katapemulihan/{id}', [UserController::class, 'katapemulihan'])->name('create_katapemulihan');

Route::get('/lupasandi', function (){ return view('lupasandi');})->name('lupasandi');
Route::post('/lupasandi',[UserController::class, 'lupasandi']);

Route::get('/inputsandi' , function (){ return view('inputsandibaru');})->name('inputsandi');
Route::put('/inputsandi/{id}', [UserController::class, 'inputsandi'])->name('change_password');


Route::get('/dashboard', function(){
    $categories = Category::get();
    $budgets = Budget::where('users_id', Auth::user()->user_id)->get();
    $budgets = $budgets->where('status', 0);
    $budgets = $budgets->sortByDesc('tanggal_berakhir');
    $budgets = $budgets->take(2);
    return view('dashboard' , ['categories' => $categories, 'budgets' => $budgets]);
})->name('dashboard')->middleware('auth');

Route::post('/inputDompet', [DompetController::class, 'inputDompet'])->name('input_dompet');
Route::post('/editDompet', [DompetController::class, 'editDompet'])->name('edit_dompet');


//test
Route::get('/testingaja', function(){return view('popup_Transaksi');});
Route::post('/inputTx', [TransactionController::class, 'inputTransaction'])->name('input_transaction');

Route::get('/pencatatan', [PencatatanController::class, 'index'])->name('pencatatan');
Route::post('/pencatatan', [PencatatanController::class, 'fetchData'])->name('pencatatan.data');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');


Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.create');
Route::put('/kategori', [CategoryController::class, 'update'])->name('kategori.update');

// Tes untuk email remainder
Route::get('/email', function(){
    Mail::to('mrcllnjoshua@gmail.com')->send(new ReminderMail());
});

Route::get('/test-email/{time}', function ($time) {
    $message = $time == 'morning' ? 'Tess Ayo semangat hari ini dan jangan lupa isi catatan keuanganmu!' : 'Selamat malamA, ayo rekap semua keuangan mu hari ini!';

    $users = User::all();
    foreach ($users as $user) {
        Mail::to($user->email)->send(new DailyReminder($message));
    }
    return 'Emails have been sent';
});

Route::get('/budget/{id}/edit', [AnggaranController::class, 'budgetData']);
Route::post('/anggaran', [AnggaranController::class, 'create'])->name('anggaran.create');
Route::put('/anggaran', [AnggaranController::class, 'edit'])->name('anggaran.edit');
Route::delete('/anggaran', [AnggaranController::class, 'destroy'])->name('anggaran.destroy');
Route::get('/anggaran-aktif' , [AnggaranController::class, 'index'])->name('anggaran.index')->middleware('auth');
Route::get('/anggaran-non-aktif' , [AnggaranController::class, 'nonIndex'])->name('anggaran.nonIndex')->middleware('auth');
