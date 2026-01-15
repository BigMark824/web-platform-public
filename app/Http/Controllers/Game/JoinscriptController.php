<?php

namespace App\Http\Controllers\Game;
use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Support\Carbon;

use App\Http\Resources\JoinscriptResource;


use GooberBlox\Data\SecurityNotary;
use GooberBlox\Security\ClientValidation;
use GooberBlox\GameInstances\Models\GameInstance; 
use GooberBlox\Assets\Models\Asset; 
class JoinscriptController
{
    public function index(Request $request)
    {
        $ticket = $request->ticket;
        $signature = $request->signature;

        if (!SecurityNotary::verifySignature($ticket, $signature)) {
            abort(403);
        }

        $ticket = json_decode($ticket, true, 512, JSON_THROW_ON_ERROR);

        $ticketTime = Carbon::createFromFormat('1 h:i:s A', $ticket['TimeStamp']);
        if ($ticketTime->diffInSeconds(Carbon::now()) > 60) {
            abort(403);
        }

        $clientTicket = ClientValidation::genClientTicket(
            $ticket['UserId'],
            $ticket['UserName'],
            $ticket['GameId'],
            $ticket['CharacterFetchUrl'],
        );

        $instance = GameInstance::getInstance( $ticket['GameId'] );

        if (!$instance) {
            abort(404);
        }

        $place = Asset::getPlace( $ticket['PlaceId'] );

        return new JoinscriptResource(
            $instance,
            $ticket['UserName'],
            $ticket['UserId'],
            $ticket['CharacterFetchUrl'],
            $clientTicket,
            $ticket['GameId'],
            $ticket['PlaceId'],
            $ticket['UniverseId'],
            $place->creator_id,
            "None", // TODO: add builders club 
            "False", // TODO: add roblox place security
            $ticket['FollowUserId'] ?? 0
        );
    }
}
