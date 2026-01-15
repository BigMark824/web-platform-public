<?php

namespace App\Http\Resources;

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

use GooberBlox\Assets\Models\Asset;
class GameJoinTicket extends JsonResource
{
    public static $wrap = null;
    public function __construct(public int $userId, public string $userName, public string $gameId, public Asset $place)
    {
        ///
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->userId < 0)
        {
            $characterAppearanceId = -124124124;
        }
        else
        {
            $characterAppearanceId = $this->userId;
        }

        return [
            'UserId' => $this->userId,
            'UserName' => $this->userName,
            'CharacterFetchUrl' => route('game.asset.character-fetch', ['userId' => $characterAppearanceId, 'placeId' => $this->place->id]),
            'GameId' => $this->gameId,
            'PlaceId' => $this->place->id,
            'UniverseId' => $this->place->universe->id,
            'IsTeleport' => false,
            'FollowUserId' => null,
            'TimeStamp' => Carbon::now()->isoFormat('1 LTS'),
            'CharacterAppearanceId' => $characterAppearanceId
        ];
    }
}
