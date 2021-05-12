<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\CorporateStatus as EnumStatus;
use Kompli\Konnect\Iterator\{
    Officers as IttOfficers,
    PSCs as IttPSCs
};
use PHPUnit\Framework\TestCase;
use Kompli\Konnect\Helper\Enum\QEDProductSendType;

class CorporateTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            'CompanyNumber',
            'JurisdictionCode',
            'Name',
            'CompanyType',
            'CurrentStatus',
            'IncorporationDate',
            'DissolutionDate',
            'RegisteredAddressInFull',
            'AddressPK',
            'CorporateFilings',
            'Officers',
            'PSCs',
            'ActsAsPsc',
            'LinkedAddresses',
            'Charges',
            'OwnershipStructure'
        ];

        $this->assertEquals($arrFields, Corporate::getFields());
    }

    public function testGetters()
    {
        $arrCorporateData = [
            Corporate::FIELD_COMPANY_NUMBER      => 'testCompanyNumber',
            Corporate::FIELD_JURISDICTION_CODE   => 'testJurisdictionCode',
            Corporate::FIELD_NAME                => 'testName',
            Corporate::FIELD_COMPANY_TYPE        => 'testCompanyType',
            Corporate::FIELD_CURRENT_STATUS      => EnumStatus::STATUS_ACTIVE,
            Corporate::FIELD_INCORPORATION_DATE  => 'testIncorporationDate',
            Corporate::FIELD_DISSOLUTION_DATE    => 'testDissolutionDate',
            Corporate::FIELD_REGISTERED_ADDRESS  => 'testRegAddressInFull',
            Corporate::FIELD_ADDRESS_PK          => 1,
            Corporate::FIELD_CORPORATE_FILINGS   => [],
            Corporate::FIELD_OFFICERS            => [],
            Corporate::FIELD_PSCS                => [],
            Corporate::FIELD_ACTS_AS_PSC         => [],
            Corporate::FIELD_LINKED_ADDRESSES    => [],
            Corporate::FIELD_CHARGES             => [],
            Corporate::FIELD_OWNERSHIP_STRUCTURE => [],
        ];

        $modelCorporate = new Corporate($arrCorporateData);

        unset($arrCorporateData[Corporate::FIELD_OFFICERS]);
        unset($arrCorporateData[Corporate::FIELD_PSCS]);

        $arrGetters = [
            Corporate::FIELD_COMPANY_NUMBER      => $modelCorporate->getCompanyNumber(),
            Corporate::FIELD_JURISDICTION_CODE   => $modelCorporate->getJurisdictionCode(),
            Corporate::FIELD_NAME                => $modelCorporate->getName(),
            Corporate::FIELD_COMPANY_TYPE        => $modelCorporate->getCompanyType(),
            Corporate::FIELD_CURRENT_STATUS      => $modelCorporate->getCurrentStatus()->getId(),
            Corporate::FIELD_INCORPORATION_DATE  => $modelCorporate->getIncorporationDate(),
            Corporate::FIELD_DISSOLUTION_DATE    => $modelCorporate->getDissolutionDate(),
            Corporate::FIELD_REGISTERED_ADDRESS  => $modelCorporate->getRegisteredAddressInFull(),
            Corporate::FIELD_ADDRESS_PK          => $modelCorporate->getAddressPK(),
            Corporate::FIELD_CORPORATE_FILINGS   => $modelCorporate->getCorporateFilings(),
            Corporate::FIELD_ACTS_AS_PSC         => $modelCorporate->getActsAsPsc(),
            Corporate::FIELD_LINKED_ADDRESSES    => $modelCorporate->getLinkedAddresses(),
            Corporate::FIELD_CHARGES             => $modelCorporate->getCharges(),
            Corporate::FIELD_OWNERSHIP_STRUCTURE => $modelCorporate->getOwnershipStructure(),
        ];

        $this->assertEquals($arrCorporateData, $arrGetters);
        $this->assertInstanceOf(IttOfficers::class, $modelCorporate->getOfficers());
        $this->assertInstanceOf(IttPSCs::class, $modelCorporate->getPSCs());
    }

    public function testHasAutoRunFields()
    {
        $arrData = [
            Corporate::FIELD_SEND_TYPE => QEDProductSendType::TYPE_SMS,
            Corporate::FIELD_PHONE_NUMBER => '0123456',
            Corporate::FIELD_TARGET_NAME => 'Target Name'
        ];

        $model = new Corporate($arrData);

        $this->assertTrue($model->hasAutoRunFields());

    }

    public function testIsMissingAllAutoRunFields()
    {
        $arrData = [
            Corporate::FIELD_TARGET_NAME => 'Target Name'
        ];

        $model = new Corporate($arrData);

        $this->assertFalse($model->isMissingAllAutoRunFields());
    }

    public function testOutputEntityData()
    {
        $arrData = [
            Corporate::FIELD_TARGET_NAME => 'TargetName',
            Corporate::FIELD_PHONE_NUMBER => 'testPhone',
            Corporate::FIELD_EMAIL => 'testEmail',
            Corporate::FIELD_MERGE_FIELDS => ['Merge Field'],
            Corporate::FIELD_INTERVIEW_TEMP_ID => 1,
            Corporate::FIELD_SEND_TYPE => QEDProductSendType::TYPE_EMAIL,
            Corporate::FIELD_INCLUDE_IN_PRODUCT => true,
        ];

        $model = new Corporate($arrData);

        $this->assertEquals($arrData, $model->outputEntityData());
    }
}