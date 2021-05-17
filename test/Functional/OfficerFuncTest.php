<?php

namespace Kompli\Konnect;

use PHPUnit\Framework\TestCase;

class OfficerFuncTest extends TestCase
{
    public function testOfficer_liveTest()
    {
        $strCRN = "247167084";
        $strApiKey = "api.key";

        // create client factory
        $konnectFactory = new KonnectFactory();

        // perform search
        $modelOfficer = $konnectFactory->build($strApiKey)->getOfficer(
            $strCRN
        );

        echo var_export(json_encode($modelOfficer->output()));

        $this->AssertTrue(true);
    }
}