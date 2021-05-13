<?php

namespace Kompli\Konnect;

use PHPUnit\Framework\TestCase;

class CorporateFuncTest extends TestCase
{
    public function testCorporate_liveTest()
    {
        $strCRN = "10247723";
        $strApiKey = "api.key";

        // create client factory
        $konnectFactory = new KonnectFactory();

        // perform search
        $modelCorporate = $konnectFactory->build($strApiKey)->getCorporate(
            $strCRN
        );

        echo var_export(json_encode($modelCorporate->output()));

        $this->AssertTrue(true);
    }
}