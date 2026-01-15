<?php

namespace App\Http\Resources;

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientValidationResource extends JsonResource
{
    public static $wrap = null;

    public function __construct(public ?array $data = null)
    {
        //
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->data ?? []
        ];
    }
}
