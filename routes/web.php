<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubroomController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/inshtellungen', [PageController::class, 'settings'])->middleware('auth')->name('settings');
Route::get('/machen', [PageController::class, 'cudRoom'])->middleware('auth');
Route::get('/{slug}/{subSlug}/{id}/bewerken', [PageController::class, 'updateSubroom'])->middleware('auth');
Route::get('/{slug}/{subSlug}/{id}/machen', [PageController::class, 'createSubroom'])->middleware('auth');
Route::get('/{slug}/bewerken', [PageController::class, 'cudRoom'])->middleware('auth'); // Create-Update-Delete
Route::get('/{slug}/machen', [PageController::class, 'createSubroom'])->middleware('auth');
Route::get('/{slug}/{subSlug}', [PageController::class, 'room'])->middleware('auth');
Route::get('/{slug}', [PageController::class, 'room'])->middleware('auth');

Route::post('/registreren', [UserController::class, 'register'])->name('account.register');
Route::post('/uitloggen', [UserController::class, 'logout'])->name('account.logout');
Route::post('/inloggen', [UserController::class, 'login'])->name('account.login');

Route::post('/maak-zimmer', [RoomController::class, 'create'])->name('room.create');

Route::post('/maak-zimmerke', [SubroomController::class, 'create'])->name('subroom.create');

Route::put('/zimmer-updaten/{room}', [RoomController::class, 'update'])->name('room.update');
Route::put('/zimmerke-updaten/{subroom}', [SubroomController::class, 'update'])->name('subroom.update');