<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubroomController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/inshtellungen', [PageController::class, 'settings'])->name('settings');
Route::get('/zimmer-machen', [PageController::class, 'workbench'])->middleware('auth');
Route::get('/{slug}', [PageController::class, 'enterRoom'])->middleware('auth');
Route::get('/{slug}/{subSlug}', [PageController::class, 'enterRoom'])->middleware('auth');

Route::post('/registreren', [UserController::class, 'register'])->name('account.register');
Route::post('/uitloggen', [UserController::class, 'logout'])->name('account.logout');
Route::post('/inloggen', [UserController::class, 'login'])->name('account.login');

Route::post('/maak-zimmer', [RoomController::class, 'create'])->name('room.create');
// Route::post('/naamwijzigen', [RoomController::class, 'editName'])->name('room.editName');
// Route::post('/kleuraanpassen', [RoomController::class, 'customizeColor'])->name('room.customizeColor');
// Route::post('/veranderpictogram', [RoomController::class, 'changeIcon'])->name('room.changeIcon');

Route::post('/maak-zimmerke', [SubroomController::class, 'create'])->name('subroom.create');
Route::post('/beschrijving-opslaan', [SubroomController::class, 'description'])->name('subroom.description');
// Route::post('/subnaamwijzigen', [SubroomController::class, 'editName'])->name('subroom.editName');
// Route::post('/subkleuraanpassen', [SubroomController::class, 'customizeColor'])->name('subroom.customizeColor');
// Route::post('/verandersubpictogram', [SubroomController::class, 'changeIcon'])->name('subroom.changeIcon');