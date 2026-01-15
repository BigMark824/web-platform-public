<?php

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Security\GetAllowedController;
use App\Http\Controllers\Client\FeatureFlagsController;

Route::domain('assetgame.' . env('APP_URL'))->group(function () {
    Route::get('/Asset', [GetAllowedController::class, 'getAllowedSecurityVersions'])->name('assetgame.asset');
});

Route::domain('clientsettings.api.' . env('APP_URL'))->group(function () {
    Route::get('/Setting/QuietGet/{Group}', [FeatureFlagsController::class, 'index'])->name('clientsettings.featureflags');
});

Route::domain('versioncompatibility.api.' . env('APP_URL'))->group(function () {
    Route::get('/GetAllowedSecurityVersions', [GetAllowedController::class, 'getAllowedSecurityVersions'])->name('versioncompatibility.securityversions');
    Route::get('/GetAllowedMD5Hashes', [GetAllowedController::class, 'getAllowedMd5Hashes'])->name('versioncompatibility.md5hashes');
});