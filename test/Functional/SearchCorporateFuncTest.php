<?php

namespace Kompli\Konnect;

use PHPUnit\Framework\TestCase;

class SearchCorporateFuncTest extends TestCase
{
    public function testCorporate_liveTest()
    {
        $strApiKey = "api.key";

        // create client factory
        $konnectFactory = new KonnectFactory();

        // perform search
        $ittCorporates = $konnectFactory->build($strApiKey)->searchCorporate(
            'Kompli'
        );

        echo json_encode($ittCorporates->toArray());

        $this->AssertTrue(true);
    }
}