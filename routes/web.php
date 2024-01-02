<?php
use App\Http\Controllers\PollsController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');

//    Polls $ Vote Codes
Route::prefix('polls')->group(function(){
    Route::view('create', 'polls.create')->name('polls.create');
    Route::post('create', [PollsController::class, 'store'])->name('polls.store');
    Route::get('/', [PollsController::class,'index'])->name('polls.index');
    Route::get('/update/{poll}', [PollsController::class,'edit'])->name('polls.edit');
    Route::put('/update/{poll}', [PollsController::class,'update'])->name('polls.update');
    Route::get('delete/{poll}',[PollsController::class,'destroy'])->name('polls.destroy');

    Route::get('/{poll}', [PollsController::class,'show'])->name('polls.show');
    Route::post('/{id}/vote', [PollsController::class,'vote'])->name('polls.vote');
});
