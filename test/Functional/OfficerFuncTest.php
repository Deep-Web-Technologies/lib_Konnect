<?php

namespace Kompli\Konnect;

use PHPUnit\Framework\TestCase;

class OfficerFuncTest extends TestCase
{
    public function testOfficer_liveTest()
    {
        $strCRN = "247167084";
        $strApiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Im1vcmdhbi5zbGF0ZXJAY2FuZGRpLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJ1c2VyX2lkIjoiYXV0aDB8NWQ5ZWYyNmNkZWQ4YmEwZTAwOGVkNDA3IiwicGljdHVyZSI6Imh0dHBzOi8vcy5ncmF2YXRhci5jb20vYXZhdGFyL2Y4ZWYwZTU1ZmM3YjI2MjQ3NmRiMzRjZDJjNDU3ZmIwP3M9NDgwJnI9cGcmZD1odHRwcyUzQSUyRiUyRmNkbi5hdXRoMC5jb20lMkZhdmF0YXJzJTJGbW8ucG5nIiwiRmlyc3ROYW1lIjoiTW9yZ2FuIiwiTGFzdE5hbWUiOiJTbGF0ZXIiLCJMYXN0QWNjb3VudCI6ImRlbW8iLCJBY2NvdW50cyI6WyJkZW1vIl0sIlVzZXJUeXBlSWQiOjIsImZsYWdVc2VyVHlwZSI6MiwiVVVJRCI6Im1vcmdhbi5zbGF0ZXJAY2FuZGRpLmNvbSIsImlzcyI6Imh0dHBzOi8vYXV0aC5rb21wbGktaXEuY29tLyIsInN1YiI6ImF1dGgwfDVkOWVmMjZjZGVkOGJhMGUwMDhlZDQwNyIsImF1ZCI6IjMxVnNXTE1BQ01RZEtXVnQ5dG1udWVsVEM2OUhMelY1IiwiaWF0IjoxNjIwOTgwNzYxLCJleHAiOjE2MjEwMTY3NjEsImF0X2hhc2giOiJDaFpvQXpPVzhCWE1QRU43bm02R3JBIiwibm9uY2UiOiIzeEVrd1FnMS0ufmZoLXoyOHYwUEN2ak5nfkFsZFlaLSJ9.xrjeEt3XYstED68j0_KBhinRVGydd1hyGEuiXhbHL-o";

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