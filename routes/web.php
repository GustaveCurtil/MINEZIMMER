<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/{id}-{slug}', [PageController::class, 'room'])->middleware('auth');
Route::get('/{id}-{slug}/{subId}-{subSlug}', [PageController::class, 'subroom'])->middleware('auth');

Route::post('/registreren', [UserController::class, 'register'])->name('account.register');
Route::post('/uitloggen', [UserController::class, 'logout'])->name('account.logout');
Route::post('/inloggen', [UserController::class, 'login'])->name('account.login');

Route::post('/kamermaken', [RoomController::class, 'create'])->name('room.create');