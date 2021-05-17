<?php

namespace Kompli\Konnect;

use PHPUnit\Framework\TestCase;

class SearchOfficerFuncTest extends TestCase
{
    public function testCorporate_liveTest()
    {
        $strApiKey = "api.key";

        // create client factory
        $konnectFactory = new KonnectFactory();

        // perform search
        $ittOfficers = $konnectFactory->build($strApiKey)->searchOfficer(
            'Tim Langley'
        );

        echo json_encode($ittOfficers->toArray());

        $this->AssertTrue(true);
    }
}