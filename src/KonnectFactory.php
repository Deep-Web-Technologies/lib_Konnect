<?php

namespace Kompli\Konnect;

use GuzzleHttp\Client as GuzzleClient;
use Kompli\Konnect\Model\{KonnectAbstract, Corporate};

class KonnectFactory
{
    public static function build(string $strApiKey) : Client
    {
        $guzzleClient = new GuzzleClient(
            [
                "base_uri"
                    => "https://api.konnect.dev-live.deepwebtechnology.com/",
                "headers" => [
                    "Accept"        => "application/json",
                    "Authorization" => $strApiKey
                ]
            ]
        );
        return new Client($guzzleClient);
    }

    public static function createKonnectEntity(
        array $arrContent
    ) : KonnectAbstract
    {
        if (!empty($arrContent['CompanyNumber'])) {
            return new Corporate($arrContent);
        }
    }
}