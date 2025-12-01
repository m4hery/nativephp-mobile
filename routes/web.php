<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParametreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SyncronisationController;

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');


Route::prefix('syncronisation')->group(function () {
    Route::post('/users', [SyncronisationController::class, 'syncUsers'])->name('syncronisation.users');
    Route::post('/all', [ParametreController::class, 'syncAll'])->name('parametre.syncAll');
});

Route::middleware('auth')->group(function (){
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');
    Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::prefix('parametre')->controller(ParametreController::class)->group(function (){
        Route::get('/', 'index')->name('parametre.index');
    });
});
