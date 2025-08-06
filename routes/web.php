<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\SubroomController;
use App\Http\Controllers\RoomMemberController;
use App\Http\Controllers\ListingItemController;

// Static routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/inshtellungen', [PageController::class, 'settings'])->middleware('auth')->name('settings');
Route::get('/zimmermachen', [PageController::class, 'createRoom'])->middleware('auth')->name('room.atelier');

// Room-specific routes
Route::prefix('{roomId}')->middleware('auth')->group(function () {
    Route::get('/bewerken', [PageController::class, 'editRoom'])->name('room.edit');

    Route::get('/zimmermachen', [PageController::class, 'createSubroom']);
    Route::get('/listemachen', [PageController::class, 'createListing']);
    Route::get('/machen', [PageController::class, 'atelier']);

    Route::get('/l-{listingId}', [PageController::class, 'listing'])->name('listing.show');
    Route::get('/l-{listingId}/bewerken', [PageController::class, 'updateListing'])->name('listing.edit');
    Route::get('/l-{listingId}/zufugen', [PageController::class, 'createListingItem'])->name('listing.add');

    Route::prefix('s-{subroomId}')->group(function () {
        Route::get('/', [PageController::class, 'room'])->name('subroom.show');

        Route::get('/bewerken', [PageController::class, 'editSubroom'])->name('subroom.edit');

        Route::get('/zimmermachen', [PageController::class, 'createSubroom'])->name('subroom.create.zimmer');
        Route::get('/listemachen', [PageController::class, 'createListing'])->name('subroom.create.liste');
        Route::get('/machen', [PageController::class, 'atelier'])->name('subroom.create.general');
    });

    Route::get('/', [PageController::class, 'room'])->name('room.show');
});

/* POST ETC. */
Route::post('/registreren', [UserController::class, 'register'])->name('account.register');
Route::post('/uitloggen', [UserController::class, 'logout'])->name('account.logout');
Route::post('/inloggen', [UserController::class, 'login'])->name('account.login');

Route::post('/maak-zimmer', [RoomController::class, 'create'])->name('room.create');
Route::post('/maak-zimmerke', [SubroomController::class, 'create'])->name('subroom.create');
Route::post('/maak-lijst', [ListingController::class, 'create'])->name('listing.create');
Route::post('/maak-lijstitem', [ListingItemController::class, 'create'])->name('listingitem.create');

Route::post('/zimmer-toevoegen', [RoomMemberController::class, 'create'])->name('roommember.create');

Route::put('/zimmer-updaten/{room}', [RoomController::class, 'update'])->name('room.update');
Route::put('/zimmerke-updaten/{subroom}', [SubroomController::class, 'update'])->name('subroom.update');
Route::put('/lijst-updaten/{listing}', [ListingController::class, 'update'])->name('listing.update');