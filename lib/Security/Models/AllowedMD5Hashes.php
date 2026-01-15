<?php

namespace GooberBlox\Security\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use GooberBlox\Security\Models\AllowedSecurityVersions;
class AllowedMD5Hashes extends Model
{
    protected $table = "allowed_md5_hashes";
    protected $fillable = [
        'id',
        'md5_hash',
        'version_id'
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('allowed_md5_hashes');
        });

        static::deleted(function () {
            Cache::forget('allowed_md5_hashes');
        });
    }

    public static function getHashes(): array
    {
        return Cache::remember('allowed_md5_hashes', now()->addDays(7), function () {
            return self::pluck('md5_hash')->toArray();
        });
    }
    public function allowedSecurityVersion()
    {
        return $this->belongsTo(AllowedSecurityVersions::class, 'version_id');
    }
}
