<?php

namespace App\Http\Controllers\Pages;
use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\Cache;
use GooberBlox\Assets\Models\Asset;
use GooberBlox\Assets\Enums\AssetType;
use Illuminate\View\View;

class GamesPageController
{
    public function index(): View
    {
        $games = Cache::remember('featured_games', 60, function () {
            return Asset::where('asset_type_id', AssetType::Place)->get();
        });

        return view('games.games', compact('games'));
    }

    public function view(int $id): View
    {
        $game = Cache::remember("game_{$id}", 60, function () use ($id) {
        return Asset::where('id', $id)
                     ->where('asset_type_id', 9)
                     ->firstOrFail();
        });

        return view('games.view', compact('game'));
    }
    
}

