<?php

namespace GooberBlox\GameInstances\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'name',
        'server_type',
        'server_status',
        'port',
        'ip_address',
        'is_alive',
        'last_heartbeat',
        'lon',
        'lat',
        'cpu_usage',
        'ram_usage',
        'rcc_jobs_open',
        'country_code'
    ];
}
