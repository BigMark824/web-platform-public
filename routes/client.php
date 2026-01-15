<?php

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Game\{ScriptController, MatchmakingController, JoinscriptController};
use App\Http\Middleware\Grid;

Route::prefix('game')->group(function () {
    Route::get('/PlaceLauncher.ashx', [MatchmakingController::class, 'index'])->name('game.placelauncher');
    Route::get('/Join.ashx', [JoinscriptController::class, 'index'])->name('game.join');
    Route::get('/Visit.ashx', [ScriptController::class, 'visit'])->name('game.visit');
    Route::get('/GameServer.ashx', [ScriptController::class, 'gameserver'])->name('game.gameserver');

    
});