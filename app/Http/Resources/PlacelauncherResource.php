<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlacelauncherResource extends JsonResource
{
    public static $wrap = null;
    public function __construct(public ?int $status = 0, public ?string $gameId = null, public ?string $joinScript = null)
    {
        parent::__construct(null);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "jobId" => $this->gameId ?? null,
            "status" => $this->status ?? 0,
            "joinScriptUrl" => $this->joinScript ?? null,
            "authenticationUrl" => null,
            "authenticationTicket" => null,
        ];
    }
}
