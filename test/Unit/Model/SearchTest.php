<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\Search;

use Kompli\Konnect\Iterator\{
    SearchOfficers as IttSearchOfficers,
    SearchCorporates as IttSearchCorporates,
};
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            Search::FIELD_COUNT,
            Search::FIELD_TOTAL,
            Search::FIELD_DATA,
        ];

        $this->assertEquals($arrFields, Search::getFields());
    }

    public function testGetters()
    {
        $arrData = [
            Search::FIELD_COUNT => 1,
            Search::FIELD_TOTAL => 2,
        ];

        $model = new Search($arrData);

        $arrGetters = [
            Search::FIELD_COUNT => $model->getCount(),
            Search::FIELD_TOTAL => $model->getTotalCount(),
        ];

        $this->assertEquals($arrData, $arrGetters);
        $this->assertInstanceOf(
            IttSearchOfficers::class,
            $model->getData(Search::TYPE_OFFICER)
        );
        $this->assertInstanceOf(
            IttSearchCorporates::class,
            $model->getData(Search::TYPE_CORPORATE)
        );
    }

    public function testOutput_Corporate()
    {
        $arrData = [
            Search::FIELD_COUNT => 1,
            Search::FIELD_TOTAL => 2,
            Search::FIELD_DATA  => [],
        ];

        $model = new Search($arrData);

        $this->assertEquals($arrData, $model->output(Search::TYPE_CORPORATE));
    }

    public function testOutput_Officer()
    {
        $arrData = [
            Search::FIELD_COUNT => 1,
            Search::FIELD_TOTAL => 2,
            Search::FIELD_DATA  => [],
        ];

        $model = new Search($arrData);

        $this->assertEquals($arrData, $model->output(Search::TYPE_OFFICER));
    }
}