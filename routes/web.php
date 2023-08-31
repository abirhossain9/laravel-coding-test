<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/deposit', [TransactionController::class, 'depositIndex'])->name('deposit.index');

Route::middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class,'index']);
    Route::get('/deposit', [TransactionController::class, 'depositIndex'])->name('deposit.index');
    Route::post('/deposit', [TransactionController::class, 'depositStore'])->name('deposit.store');
    Route::get('/withdrawal', [TransactionController::class, 'withdrawalIndex'])->name('withdrawal.index');
    Route::post('/withdrawal', [TransactionController::class, 'withdrawaAmount'])->name('withdrawal.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
