<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Game\{ScriptController};
use App\Http\Controllers\Persistence\PersistenceController;

Route::get('/Asset/CharacterFetch.ashx', function()
{
    return "test";
})->name('game.asset.character-fetch');


Route::middleware('Grid')->group(function () {
    Route::get('/Game/PlaceSpecificScript.ashx', [ScriptController::class, 'placeSpecific'])->name('game.place-specific-script');

    // Data Persistence
    Route::get('/Persistence/GetBlobUrl.ashx', [PersistenceController::class, 'get'])->name('persistence.getblob');
    Route::post('/Persistence/SetBlob.ashx', [PersistenceController::class, 'set'])->name('persistence.setblob');

});