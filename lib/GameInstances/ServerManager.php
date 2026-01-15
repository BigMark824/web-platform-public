<?php

namespace GooberBlox\GameInstances;

use Illuminate\Support\Facades\Cache;

use GooberBlox\GameInstances\Models\Server;
use GooberBlox\GameInstances\Enums\ServerType;
use GooberBlox\GameInstances\Exceptions\NoAvailableServerException;
class ServerManager
{
    // TODO: Implement matchmaking
    public static function getServer()
    {
        $server = Cache::remember('live_server', 60, function () {
            return Server::where('is_alive', true)
                ->where(function ($query) {
                    $query->where('server_type', ServerType::Gameserver)
                        ->orWhere('server_type', ServerType::MixServer);
                })
                ->first();
        });

        if (!$server) 
            throw new NoAvailableServerException("No available game servers found.");

        return $server;
    }

}
