<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\CorporateHistoricName;

use PHPUnit\Framework\TestCase;

class CorporateHistoricNameTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            CorporateHistoricName::FIELD_COMPANY_NAME,
            CorporateHistoricName::FIELD_DATE_FROM,
            CorporateHistoricName::FIELD_DATE_TO,
        ];

        $this->assertEquals($arrFields, CorporateHistoricName::getFields());
    }

    public function testGetters()
    {
        $arrData = [
            CorporateHistoricName::FIELD_COMPANY_NAME => 'testName',
            CorporateHistoricName::FIELD_DATE_FROM => 'testDateFrom',
            CorporateHistoricName::FIELD_DATE_TO => 'testDateTo'
        ];

        $model = new CorporateHistoricName($arrData);

        $arrGetters = [
            CorporateHistoricName::FIELD_COMPANY_NAME => $model->getCompanyName(),
            CorporateHistoricName::FIELD_DATE_FROM => $model->getDateFrom(),
            CorporateHistoricName::FIELD_DATE_TO => $model->getDateTo(),
        ];

        $this->assertEquals($arrData, $arrGetters);
    }

    public function testOutput()
    {
        $arrData = [
            CorporateHistoricName::FIELD_COMPANY_NAME => 'testName',
            CorporateHistoricName::FIELD_DATE_FROM => 'testDateFrom',
            CorporateHistoricName::FIELD_DATE_TO => 'testDateTo'
        ];

        $model = new CorporateHistoricName($arrData);

        $this->assertEquals($model->output(), $arrData);
    }
}