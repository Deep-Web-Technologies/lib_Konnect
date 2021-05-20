<?php
namespace Kompli\Konnect;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

use Kompli\Konnect\Model\{
    Corporate as ModelCorporate,
    Officer as ModelOfficer,
    Search as ModelSearch
};
use Kompli\Konnect\Iterator\{
    SearchOfficers as IttSearchOfficers,
    SearchCorporates as IttSearchCorporates
};

class KonnectClientTest extends TestCase
{
    public function testGuzzleCalls()
    {
        $arrCorporateRes = ['data3' => 'test3'];
        $arrOfficerRes = ['data4' => 'test5'];
        $arrSearchCorpRes = ['data7' => 'test7'];
        $arrSearchOffRes = ['data8' => 'test8'];

        $mock = new MockHandler([
            new Response(200, ['Foo' => 'Bar'], json_encode($arrCorporateRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrOfficerRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrSearchCorpRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrSearchOffRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrCorporateRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrOfficerRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrSearchCorpRes)),
            new Response(200, ['Foo' => 'Bar'], json_encode($arrSearchOffRes)),
        ]);

        $handler = HandlerStack::create($mock);
        $client  = new GuzzleClient(['handler' => $handler]);
        $client  = new Client($client);

        $this->assertEquals($arrCorporateRes, $client->getCorporate('testCRN')->toArray());
        $this->assertEquals($arrOfficerRes, $client->getOfficer(1234)->toArray());
        $this->assertEquals($arrSearchCorpRes, $client->searchCorporate('Name')->toArray());
        $this->assertEquals(
            $arrSearchOffRes,
            $client->searchOfficer('Name', 'Address', 'CorporateName', 'CRN', 30)->toArray()
        );
        $this->assertInstanceOf(ModelCorporate::class, $client->getCorporate('testCRN'));
        $this->assertInstanceOf(ModelOfficer::class, $client->getOfficer(1234));
        $this->assertInstanceOf(ModelSearch::class, $client->searchCorporate('Name'));
        $this->assertInstanceOf(
            ModelSearch::class,
            $client->searchOfficer('Name', 'Address', 'CorporateName', 'CRN', 30)
        );
    }
}