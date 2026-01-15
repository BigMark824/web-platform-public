<?php

namespace App\Http\Controllers\Security;

use App\Http\Requests\InsensitiveRequest as Request;

use App\Http\Resources\{ClientValidationResource, DefaultErrorResource};

use GooberBlox\Security\ClientValidation;
use GooberBlox\Security\Exceptions\InvalidApiKeyException;
class GetAllowedController 
{
    public function getAllowedMd5Hashes(Request $request)
    {
        $apiKey = $request->apiKey;
        try {
            $allowedMd5hashes = ClientValidation::getAllowedMd5Hashes($apiKey);

            return new ClientValidationResource(data: $allowedMd5hashes);
        } catch(InvalidApiKeyException $e) {
            return (new DefaultErrorResource('Invalid API Key'))
                    ->response()
                    ->setStatusCode(403);
        }

    }

    public function getAllowedSecurityVersions(Request $request)
    {
        $apiKey = $request->apiKey;
        try {
            $allowedSecurityVersions = ClientValidation::getAllowedSecurityVersions($apiKey);

            return new ClientValidationResource(data: $allowedSecurityVersions);
        } catch(InvalidApiKeyException $e) {
            return (new DefaultErrorResource('Invalid API Key'))
                    ->response()
                    ->setStatusCode(403);
        }
    }
}
