<?php

namespace Kompli\Konnect;

use GuzzleHttp\Client as GuzzleClient;
use Kompli\Konnect\Model\{Officer, Corporate};

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

    public static function createCorporate(
        array $arrContent
    ) : Corporate
    {
        return new Corporate($arrContent);
    }

    public static function createOfficer(
        array $arrContent
    ) : Officer
    {
        return new Officer($arrContent);
    }
}