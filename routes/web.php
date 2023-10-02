<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeaponController;

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
    return redirect('weapons.root');
})->name('welcome');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::controller(WeaponController::class)->group(function(){
    Route::get('/armas', 'root')->name('weapons.root');
    Route::get('/armas/{type}', 'index')->name('weapons.index');
});

Route::middleware('auth')->controller(WeaponController::class)->group(function () {
    Route::get('/armas/{type}/crear', 'create')->name('weapons.create');
    Route::post('/armas', 'store')->name('weapons.store');
    Route::get('/armas/{weapon}/editar', 'edit')->name('weapons.edit');
    Route::put('/armas/{weapon}', 'update')->name('weapons.update');
    Route::delete('/armas/{weapon}', 'destroy')->name('weapons.destroy');
});

Route::get('/panel', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
