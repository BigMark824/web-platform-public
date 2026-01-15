<?php

namespace App\Http\Controllers\Game;
use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Facades\Auth, Log;
use App\Http\Resources\{GameJoinTicket, PlacelauncherResource};
use App\Http\Controllers\Controller;

use App\Helpers\UserHelper;
use App\Jobs\StartGame;

use GooberBlox\Data\SecurityNotary;
use GooberBlox\Assets\Models\Asset;
use GooberBlox\GameInstances\InstanceManager;
class MatchmakingController extends Controller
{
    public function index(Request $request): PlacelauncherResource
    {
        $placeRequest = $request->input('request') ?? "RequestGame";
        $placeId = $request->placeId;
        $place = Asset::getPlace($placeId);

        $user = Auth::check() ? Auth::user() : UserHelper::getGuestUser();

        switch ($placeRequest) {
            case "RequestGame":
            default:
                return $this->requestGame($place, $user, false);
        }

    }

    public function requestGame(Asset $place, $user, bool $isCloudEdit): PlacelauncherResource
    {
        $instanceManager = new InstanceManager($place->id);

        $instance = null;
        $joinScript = null;
        $jobId = null;
        $status = 0;

        try {
            $instance = $instanceManager->getInstance();

            if ($instance) {
                $status = 2; 
                $jobId = $instance->id;

                $joinTicket = new GameJoinTicket($user->id, $user->name, $instance->id ?? "", $place);
                $joinTicket = $joinTicket->toJson();

                $joinScript = route('game.join', [
                    'ticketVersion' => 2,
                    'ticket' => $joinTicket,
                    'signature' => SecurityNotary::createSignature($joinTicket),
                    'browserTrackerId' => 0 // implement later on
                ]);
            } else {
                $instanceManager->requestInstance();
                $status = 0; 
            }

        } catch (\Exception $e) {
            Log::error("Error in requestGame: " . $e->getMessage());
            $status = 4;
        }

        return new PlacelauncherResource(status: $status ?? 0, gameId: $jobId ?? null, joinScript: $joinScript ?? null);
    }

}