<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Admin\TonnerController; 
use App\Http\Controllers\ImpressoraController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\OidsController;
use App\Http\Controllers\ConfigScriptController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;

Route::middleware(['auth'])->group(function(){
    Route::get('/configs/oids', [OidsController::class, 'index'])->name('oids.index'); 
    Route::get('/configs/oids/{id}', [OidsController::class, 'edit'])->name('oids.edit'); 
    Route::put('/configs/oids/{id}', [OidsController::class, 'update'])->name('oids.update'); 

    Route::post('/configs/marcas', [MarcasController::class, 'store'])->name('marcas.store'); 
    Route::get('/configs/marcas/create', [MarcasController::class, 'create'])->name('marcas.create'); 
    Route::get('/configs/marcas', [MarcasController::class, 'index'])->name('marcas.index'); 
    Route::get('/configs/{marca}/{id}/edit', [MarcasController::class, 'edit'])->name('marcas.edit'); 
    Route::delete('/configs/marcas/{id}', [MarcasController::class, 'delete'])->name('marcas.delete');

    Route::put('/configs/{marca}/{id}', [MarcasController::class, 'update'])->name('modelo.update'); 
    Route::delete('/configs/{marca}/{id}/edit', [ModelosController::class, 'delete'])->name('modelo.delete');

    Route::get('/configs/{id}/edit', [ConfigScriptController::class, 'edit'])->name('configs.edit');
    Route::put('/configs/{id}', [ConfigScriptController::class, 'update'])->name('configs.update');
    Route::get('/configs', [ConfigScriptController::class, 'index'])->name('configs.index'); 

    Route::delete('/impressoras/{printer}/tonners/{id}', [TonnerController::class, 'delete'])->name('tonners.delete'); 
    Route::get('/impressoras/{printer}/tonners/{id}', [TonnerController::class, 'edit'])->name('tonners.edit'); 
    Route::post('/impressoras/{id}/tonners', [TonnerController::class, 'store'])->name('tonners.store'); 
    Route::get('/impressoras/{id}/tonners/create', [TonnerController::class, 'create'])->name('tonners.create'); 
    Route::get('/impressoras/{id}/tonners', [TonnerController::class, 'index'])->name('tonners.indexColorida'); 

    Route::delete('/impressoras/{id}', [ImpressoraController::class, 'delete'])->name('impressoras.delete'); 
    Route::put('/impressoras/{id}', [ImpressoraController::class, 'update'])->name('impressoras.update'); 
    Route::get('/impressoras/{id}/edit', [ImpressoraController::class, 'edit'])->name('impressoras.edit'); 
    Route::get('/impressoras', [ImpressoraController::class, 'index'])->name('impressoras.index'); 
    Route::get('/impressoras/create', [ImpressoraController::class, 'create'])->name('impressoras.create'); 
    Route::post('/impressoras', [ImpressoraController::class, 'store'])->name('impressoras.store'); 
    Route::get('/impressoras/{id}', [ImpressoraController::class, 'show'])->name('impressoras.show'); 

    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete'); 
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); 
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); 
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); 
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); 
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); 
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->middleware('auth'); 

    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard'); 
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('auth.login'); 
}); 



