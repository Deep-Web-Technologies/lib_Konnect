<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\SearchCorporate;
use PHPUnit\Framework\TestCase;
use Kompli\Konnect\Iterator\CorporateHistoricNames as IttHistNames;

class SearchCorporateTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            SearchCorporate::FIELD_TYPE,
            SearchCorporate::FIELD_ID,
            SearchCorporate::FIELD_WEIGHT,
            SearchCorporate::FIELD_CORPORATE,
            SearchCorporate::FIELD_CRN,
            SearchCorporate::FIELD_STATUS,
            SearchCorporate::FIELD_INCORPORATION_DATE,
            SearchCorporate::FIELD_ADDRESS,
            SearchCorporate::FIELD_PREVIOUS_NAMES,
            SearchCorporate::FIELD_HISTORIC_NAMES,
        ];

        $this->assertEquals($arrFields, SearchCorporate::getFields());
    }

    public function testGetters()
    {
        $arrData = [
            SearchCorporate::FIELD_TYPE => 'corporate',
            SearchCorporate::FIELD_ID => 'testId',
            SearchCorporate::FIELD_WEIGHT => '123.12',
            SearchCorporate::FIELD_CORPORATE => 'testCorporate',
            SearchCorporate::FIELD_CRN => 'a123',
            SearchCorporate::FIELD_STATUS => 'active',
            SearchCorporate::FIELD_INCORPORATION_DATE => '1234-12-12',
            SearchCorporate::FIELD_ADDRESS => 'testAddress',
            SearchCorporate::FIELD_PREVIOUS_NAMES => 'prevName|prevName2',
            SearchCorporate::FIELD_HISTORIC_NAMES => [
                [
                    'CompanyName' =>'histName',
                    'DateFrom' => '1234-12-12',
                    'DateTo' => '1234-12-12'
                ]
            ],
        ];

        $model = new SearchCorporate($arrData);

        $arrGetters = [
            SearchCorporate::FIELD_TYPE => $model->getType(),
            SearchCorporate::FIELD_ID => $model->getId(),
            SearchCorporate::FIELD_WEIGHT => $model->getWeight(),
            SearchCorporate::FIELD_CORPORATE => $model->getCorporate(),
            SearchCorporate::FIELD_CRN => $model->getCRN(),
            SearchCorporate::FIELD_STATUS => $model->getStatus(),
            SearchCorporate::FIELD_INCORPORATION_DATE => $model->getIncorporationDate(),
            SearchCorporate::FIELD_ADDRESS => $model->getAddress(),
            SearchCorporate::FIELD_PREVIOUS_NAMES => $model->getPreviousNames(),
            SearchCorporate::FIELD_HISTORIC_NAMES => $model->getHistoricNames()
        ];

        $arrOutput = [
            SearchCorporate::FIELD_TYPE => 'corporate',
            SearchCorporate::FIELD_ID => 'testId',
            SearchCorporate::FIELD_WEIGHT => '123.12',
            SearchCorporate::FIELD_CORPORATE => 'testCorporate',
            SearchCorporate::FIELD_CRN => 'a123',
            SearchCorporate::FIELD_STATUS => 'active',
            SearchCorporate::FIELD_INCORPORATION_DATE => '1234-12-12',
            SearchCorporate::FIELD_ADDRESS => 'testAddress',
            SearchCorporate::FIELD_PREVIOUS_NAMES => ['prevName', 'prevName2'],
            SearchCorporate::FIELD_HISTORIC_NAMES => new IttHistNames([
                [
                    'CompanyName' =>'histName',
                    'DateFrom' => '1234-12-12',
                    'DateTo' => '1234-12-12'
                ]
            ])
        ];

        $this->assertEquals($arrOutput, $arrGetters);
    }

    public function testOutput()
    {
        $arrData = [
            SearchCorporate::FIELD_TYPE => 'corporate',
            SearchCorporate::FIELD_ID => 'testId',
            SearchCorporate::FIELD_WEIGHT => '123.12',
            SearchCorporate::FIELD_CORPORATE => 'testCorporate',
            SearchCorporate::FIELD_CRN => 'a123',
            SearchCorporate::FIELD_STATUS => 'active',
            SearchCorporate::FIELD_INCORPORATION_DATE => '1234-12-12',
            SearchCorporate::FIELD_ADDRESS => 'testAddress',
            SearchCorporate::FIELD_PREVIOUS_NAMES => 'prevName|prevName2',
            SearchCorporate::FIELD_HISTORIC_NAMES => [
                [
                    'CompanyName' =>'histName',
                    'DateFrom' => '1234-12-12',
                    'DateTo' => '1234-12-12'
                ]
            ]
        ];

        $arrOutput = [
            SearchCorporate::FIELD_TYPE => 'corporate',
            SearchCorporate::FIELD_ID => 'testId',
            SearchCorporate::FIELD_WEIGHT => '123.12',
            SearchCorporate::FIELD_CORPORATE => 'testCorporate',
            SearchCorporate::FIELD_CRN => 'a123',
            SearchCorporate::FIELD_STATUS => 'active',
            SearchCorporate::FIELD_INCORPORATION_DATE => '1234-12-12',
            SearchCorporate::FIELD_ADDRESS => 'testAddress',
            SearchCorporate::FIELD_PREVIOUS_NAMES => ['prevName', 'prevName2'],
            SearchCorporate::FIELD_HISTORIC_NAMES => [
                [
                    'CompanyName' =>'histName',
                    'DateFrom' => '1234-12-12',
                    'DateTo' => '1234-12-12'
                ]
            ]
        ];

        $model = new SearchCorporate($arrData);

        $this->assertEquals($model->output(), $arrOutput);
    }
}