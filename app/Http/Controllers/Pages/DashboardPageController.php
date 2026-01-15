<?php

namespace App\Http\Controllers\Pages;
use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\Cache;
use GooberBlox\Assets\Models\Asset;
use GooberBlox\Assets\Enums\AssetType;
use Illuminate\View\View;

class DashboardPageController
{
    public function index() : View
    {
        $gamesAvailable = Cache::remember('games_available', 300, function () {
            return Asset::where('asset_type_id', AssetType::Place)->count();
        });

        return view('welcome', 
        [
            'gamesAvailable' => $gamesAvailable
        ]);
    }
}
