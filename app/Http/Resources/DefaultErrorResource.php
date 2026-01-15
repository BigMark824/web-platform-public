<?php

namespace App\Http\Resources;

use App\Http\Requests\InsensitiveRequest as Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultErrorResource extends JsonResource
{
    public static $wrap = null;

    public function __construct(public string $error)
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
            'success' => false,
            'error' => $this->error
        ];
    }
}
