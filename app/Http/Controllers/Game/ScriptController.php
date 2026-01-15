<?php

namespace App\Http\Controllers\Game;

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\{Storage, Cache, Auth};
use Illuminate\Http\Response;

use App\Helpers\UserHelper;

use GooberBlox\Assets\Models\Asset;
use GooberBlox\Assets\Enums\AssetType;

use GooberBlox\Data\SecurityNotary;
use GooberBlox\Data\Enums\FormatVersion;
class ScriptController
{
    public function gameserver(Request $request) : Response
    {        
        $script = $this->getScript('Gameserver');

        return response( SecurityNotary::signScript($script)  )
            ->header('Content-Type', 'text/plain');
    }
    public function placeSpecific(Request $request) : Response
    {       
        // TODO: Finish, requires asset validation 
        $placeId = $request->placeId;

        if(!$placeId)
            abort(400, "No PlaceId supplied.");

        $script = $this->getScript('PlaceSpecificScript');

        $script = str_replace(
            ['{placeId}', '{baseUrl}'],
            [ $placeId, env('APP_URL') ], 
        $script);

        return response( SecurityNotary::signScript($script)  )
            ->header('Content-Type', 'text/plain');
    }
    public function visit(Request $request) : Response
    {
        $account = Auth::user();

        if(!$account)
        {
            $guestId = UserHelper::getDisplayGuestId();
        }
        
        $script = $this->getScript('Visit');

        $placeId = $request->placeId;

        if(!$placeId)
            abort(400, "No PlaceId supplied.");

        try {
            $place = Asset::getPlace( $placeId );
        } catch (\Exception $e)
        {
            abort(400);
        }

        $script = str_replace(
            ['{baseUrl}', '{userId}', '{userName}', '{placeId}', '{universeId}'],
            [ env('APP_MINIURL'), $account->user->id ?? 0, $account->name ?? "Guest {$guestId}", $place->id ?? 1818 , $place->universe->id ?? 0], 
            $script);

        return response( SecurityNotary::signScript($script)  )
            ->header('Content-Type', 'text/plain');
    }

    private function getScript(string $script) : string
    {
        $cachedScript = Cache::remember("lua:{$script}", 3600, function() use ($script) {
            return Storage::get("scripts/{$script}.lua");
        });

        return $cachedScript;
    }
}
