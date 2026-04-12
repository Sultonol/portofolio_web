<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'home'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/folder', [DashboardController::class, 'storeFolder'])->name('folder.store');
Route::post('/dashboard/file', [DashboardController::class, 'storeFile'])->name('file.store');
Route::put('/folder/rename/{id}', [DashboardController::class, 'renameFolder'])->name('folder.rename');
Route::delete('/folder/delete/{id}', [DashboardController::class, 'deleteFolder'])->name('folder.delete');
Route::put('/file/rename/{id}', [DashboardController::class, 'renameFile'])->name('file.rename');
Route::delete('/file/delete/{id}', [DashboardController::class, 'deleteFile'])->name('file.delete');
Route::post('/shortcut/store', [DashboardController::class, 'storeShortcut'])->name('shortcut.store');
Route::delete('/shortcut/delete/{id}', [DashboardController::class, 'deleteShortcut'])->name('shortcut.delete');
Route::put('/shortcut/update/{id}', [DashboardController::class, 'updateShortcut'])->name('shortcut.update');
