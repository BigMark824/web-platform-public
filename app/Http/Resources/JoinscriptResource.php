<?php

namespace App\Http\Resources;

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Http\Resources\Json\JsonResource;

use GooberBlox\GameInstances\Models\GameInstance;
class JoinscriptResource extends JsonResource
{
    public static $wrap = null;
    public function __construct(
        public GameInstance $instance,
        public string $userName,
        public int $userId,
        public string $charApp, 
        public string $clientTicket, 
        public string $gameId, 
        public int $placeId, 
        public int $universeId, 
        public int $creatorId,
        public string $membershipType, 
        public string $rbxSecurity,
        public int $followUserId
        ){}
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
            return [
            "ClientPort" => 0,
            "MachineAddress" => $this->instance->server->ip_address,
            "ServerPort" => $this->instance->port,
            "UserName" => $this->userName,
            "PingUrl" => "",
            "PingInterval" => 0,
            "SeleniumTestMode" => false,
            "UserId" => $this->userId,
            "RobloxLocale" => "en_us",
            "GameLocale" => "en_us",
            "SuperSafeChat" => false,
            "CharacterAppearance" => $this->charApp,
            "ClientTicket" => $this->clientTicket,
            "GameId" => $this->gameId,
            "PlaceId" => $this->placeId,
            "MeasurementUrl" => "",
            "WaitingForCharacterGuid" => "2228a26f-5158-4d50-acbe-c9053997673e",
            "BaseUrl" => env('APP_URL'),
            "ChatStyle" => "ClassicAndBubble",
            "VendorId" => 0,
            "ScreenShotInfo" => "",
            "VideoInfo" => "",
            "CreatorId" => $this->creatorId,
            "CreatorTypeEnum" => "User",
            "MembershipType" => $this->membershipType ?? "None",
            "AccountAge" => 365,
            "CookieStoreFirstTimePlayKey" => "rbx_evt_ftp",
            "CookieStoreFiveMinutePlayKey" => "rbx_evt_fmp",
            "CookieStoreEnabled" => true,
            "IsRobloxPlace" => $joinscriptInfo["RbxSecurity"] ?? "false",
            "GenerateTeleportJoin" => false,
            "IsUnknownOrUnder13" => false,
            "GameChatType" => "AllUsers",
            "SessionId" => "",
            "AnalyticsSessionId" => "67914290-6cf1-4339-8464-68d816626608",
            "DataCenterId" => $this->instance->server->id,
            "UniverseId" => $this->universeId,
            "BrowserTrackerId" => 0,
            "UsePortraitMode" => false,
            "FollowUserId" => $this->followUserId ?? 0,
            "characterAppearanceId" => $this->userId,
        ];
    }
}
