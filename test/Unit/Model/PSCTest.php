<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\{
    PSCKind,
    QEDProductSendType
};
use PHPUnit\Framework\TestCase;

class PSCTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            'AddressPK',
            'FirstName',
            'LastName',
            'CompanyNumber',
            'JurisdictionCode',
            'Kind',
            'CHPSCId',
            'PSCId',
            'Name',
            'Data'
        ];

        $this->assertEquals($arrFields, PSC::getFields());
    }

    public function testGetters()
    {
        $strJurisdictionCode = 'testJurisdiction';
        $strCompanyNumber    = 'testCRN';
        $intKind             = PSCKind::ID_INDIVIDUAL_PSC;
        $strCHPSCId          = 'testCHPSCID';

        $arrPSCData = [
            PSC::PRIMARY_KEY          => PSC::FIELD_PSC_ID,
            PSC::FIELD_ADDRESS_PK     => 2,
            PSC::FIELD_FIRST_NAME     => 'testFirst',
            PSC::FIELD_LAST_NAME      => 'testLast',
            PSC::FIELD_COMPANY_NUMBER => $strCompanyNumber,
            PSC::FIELD_JURISDICTION   => $strJurisdictionCode,
            PSC::FIELD_KIND           => $intKind,
            PSC::FIELD_CHPSC_ID       => $strCHPSCId,
            PSC::FIELD_NAME           => 'testName',
            PSC::FIELD_DATA           => [PSC::FIELD_DATA_CEASED => '2000-01-02'],
            PSC::FIELD_PARTIAL_DOB    => '2000-02-02'
        ];

        $modelPSC = new PSC($arrPSCData);

        $arrGetters = [
            PSC::PRIMARY_KEY          => $modelPSC->getPrimaryKey(),
            PSC::FIELD_ADDRESS_PK     => $modelPSC->getAddressPK(),
            PSC::FIELD_FIRST_NAME     => $modelPSC->getFirstName(),
            PSC::FIELD_LAST_NAME      => $modelPSC->getLastName(),
            PSC::FIELD_COMPANY_NUMBER => $modelPSC->getCompanyNumber(),
            PSC::FIELD_JURISDICTION   => $modelPSC->getJurisdictionCode(),
            PSC::FIELD_KIND           => $modelPSC->getKind()->getId(),
            PSC::FIELD_CHPSC_ID       => $modelPSC->getCHPSCId(),
            PSC::FIELD_NAME           => $modelPSC->getName(),
            PSC::FIELD_DATA           => $modelPSC->getData(),
            PSC::FIELD_PARTIAL_DOB    => $modelPSC->getPartialDateOfBirth()
        ];

        $strVertexId = "p/$strJurisdictionCode,$strCompanyNumber/$intKind/$strCHPSCId";

        $this->assertEquals($arrPSCData, $arrGetters);
        $this->assertFalse($modelPSC->isActive());
        $this->assertEquals($modelPSC->getKonnectVertexId(), $strVertexId);
    }

    public function testOutput()
    {
        $arrPSCData = [
            PSC::FIELD_PSC_ID         => 1,
            PSC::FIELD_ADDRESS_PK     => 2,
            PSC::FIELD_FIRST_NAME     => 'testFirst',
            PSC::FIELD_LAST_NAME      => 'testLast',
            PSC::FIELD_COMPANY_NUMBER => 'testCRN',
            PSC::FIELD_JURISDICTION   => 'testJurisdiction',
            PSC::FIELD_KIND           => PSCKind::ID_INDIVIDUAL_PSC,
            PSC::FIELD_CHPSC_ID       => 'testCHPSCID',
            PSC::FIELD_NAME           => 'testName',
            PSC::FIELD_DATA           => []
        ];

        $modelPSC = new PSC($arrPSCData);

        $this->assertEquals($arrPSCData, $modelPSC->output());
    }

    public function testOutputEntityData()
    {
        $arrData = [
            Officer::FIELD_PARTIAL_DOB => '2000-01-01',
            Officer::FIELD_PHONE_NUMBER => 'testPhone',
            Officer::FIELD_EMAIL => 'testEmail',
            Officer::FIELD_MERGE_FIELDS => ['Merge Field'],
            Officer::FIELD_INTERVIEW_TEMP_ID => 1,
            Officer::FIELD_SEND_TYPE => QEDProductSendType::TYPE_EMAIL,
            Officer::FIELD_INCLUDE_IN_PRODUCT => true,
        ];

        $model = new Officer($arrData);

        $this->assertEquals($arrData, $model->outputEntityData());
    }
}
