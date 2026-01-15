<?php

namespace GooberBlox\Security\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AllowedSecurityVersions extends Model
{
    protected $fillable = [
        'id',
        'version'
    ];
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('allowed_security_versions');
        });

        static::deleted(function () {
            Cache::forget('allowed_security_versions');
        });
    }
    public static function getVersions(): array
    {
        return Cache::remember('allowed_security_versions', now()->addDays(7), function () {
            return self::pluck('version')->toArray();
        });
    }
    public function allowedMd5Hashes()
    {
        return $this->hasMany(AllowedMD5Hashes::class, 'version_id');
    }
}
