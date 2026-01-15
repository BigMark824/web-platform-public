<?php

namespace App\Http\Controllers\Persistence;
use App\Http\Requests\InsensitiveRequest as Request;

use GooberBlox\Persistence\Persistence;
class PersistenceController
{
    public function get(Request $request)
    {
        $agentId = $request->userId;
        $placeId = $request->placeId;

        $blob = Persistence::getBlob($agentId, $placeId);

        return response($blob?->blob ?? '<Table></Table>')
            ->header('Content-Type', 'text/xml');
    }

    public function set(Request $request)
    {
        $agentId = $request->userId;
        $placeId = $request->placeId;

        Persistence::setBlob($agentId, $placeId, $request->getContent());

        return response('')
            ->header('Content-Type', 'text/plain');
    }
}
