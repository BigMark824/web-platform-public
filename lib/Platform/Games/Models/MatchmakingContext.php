<?php

namespace GooberBlox\Platform\Games\Models;

use Illuminate\Database\Eloquent\Model;

class MatchmakingContext extends Model
{
    protected $fillable = [
        'value',
    ];
    public static function get(string $value): self
    {
        return self::firstOrCreate(
            ['value' => $value],
        );
    }
}
