<?php

namespace App\Http\Controllers\Client;
use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Carbon;

use GooberBlox\Features\Models\FeatureFlags;
class FeatureFlagsController
{
    public function index(Request $request, ?string $group)
    {
        $apiKey = $request->apiKey;

        if($apiKey !== env('GRID_API_KEY'))
            abort(403);
        
        $flags = FeatureFlags::where('group', $group)->pluck('value', 'name');

        if ($flags->isEmpty()) 
            abort(404);

        return response($flags);
    }
}
