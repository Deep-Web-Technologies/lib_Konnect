<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\CorporateStatus as EnumStatus;
use Kompli\Konnect\Iterator\{
    Officers as IttOfficers,
    PSCs as IttPSCs,
    Corporates as IttCorporates
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
            Corporate::FIELD_LINKED_ADDRESSES    => [],
            Corporate::FIELD_CHARGES             => [],
            Corporate::FIELD_OWNERSHIP_STRUCTURE => [],
            Corporate::FIELD_HISTORIC_NAMES => ['historic'],
            Corporate::FIELD_NATURE_OF_BUSINESS => [],
            Corporate::FIELD_PREVIOUS_NAMES => ['historic name'],
            Corporate::FIELD_RETIEVED_AT => 'retrieved at',
            Corporate::FIELD_NOC_NOT_ADDING_UP => false,
            Corporate::FIELD_REGISTRY_URL => 'registry' ,
            Corporate::FIELD_ACCOUNTS_REF_DATE => 'accounts ref',
            Corporate::FIELD_ACCOUNTS_LAST_UP_DATE => 'accounts up to date',
            Corporate::FIELD_ANNUAL_RETURN_LAST_UP_DATE => 'annual return last',
            Corporate::FIELD_INDUSTRY_CODES => 'industry codes',
            Corporate::FIELD_KONNECT_ID => 'konnect id',
            Corporate::FIELD_REQUESTOR => 'requester',
            Corporate::FIELD_VAT => [],
            Corporate::FIELD_ICO_REGISTER => []
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
            Corporate::FIELD_LINKED_ADDRESSES    => $modelCorporate->getLinkedAddresses(),
            Corporate::FIELD_CHARGES             => $modelCorporate->getCharges(),
            Corporate::FIELD_OWNERSHIP_STRUCTURE => $modelCorporate->getOwnershipStructure(),
            Corporate::FIELD_HISTORIC_NAMES => $modelCorporate->getHistoricNames(),
            Corporate::FIELD_NATURE_OF_BUSINESS => $modelCorporate->getNatureOfBusiness(),
            Corporate::FIELD_PREVIOUS_NAMES => $modelCorporate->getPreviousNames(),
            Corporate::FIELD_RETIEVED_AT => $modelCorporate->getRetrievedAt(),
            Corporate::FIELD_NOC_NOT_ADDING_UP => $modelCorporate->getNocNotAddingUp(),
            Corporate::FIELD_REGISTRY_URL => $modelCorporate->getRegistryUrl(),
            Corporate::FIELD_ACCOUNTS_REF_DATE => $modelCorporate->getAccountsReferenceDate(),
            Corporate::FIELD_ACCOUNTS_LAST_UP_DATE => $modelCorporate->getAccountsLastMadeUpDate(),
            Corporate::FIELD_ANNUAL_RETURN_LAST_UP_DATE => $modelCorporate->getAnnualReturnLastMadeUpDate(),
            Corporate::FIELD_INDUSTRY_CODES => $modelCorporate->getIndustryCodes(),
            Corporate::FIELD_KONNECT_ID => $modelCorporate->getKonnectId(),
            Corporate::FIELD_REQUESTOR => $modelCorporate->getRequestor(),
            Corporate::FIELD_VAT => $modelCorporate->getVAT(),
            Corporate::FIELD_ICO_REGISTER => $modelCorporate->getICORegisterEntries(),
        ];

        $this->assertEquals($arrCorporateData, $arrGetters);
        $this->assertInstanceOf(IttOfficers::class, $modelCorporate->getOfficers());
        $this->assertInstanceOf(IttPSCs::class, $modelCorporate->getPSCs());
        $this->assertInstanceOf(IttCorporates::class, $modelCorporate->getActsAsPsc());
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

    public function testOutput()
    {
        $arrData = [
            Corporate::FIELD_KONNECT_ID => 'KonnectId',
            Corporate::FIELD_COMPANY_NUMBER => 'company number',
            Corporate::FIELD_JURISDICTION_CODE => 'jurisdiction',
            Corporate::FIELD_NAME => 'name',
            Corporate::FIELD_COMPANY_TYPE => 'company type',
            Corporate::FIELD_CURRENT_STATUS => 'Active',
            Corporate::FIELD_INCORPORATION_DATE => 'incorporation date',
            Corporate::FIELD_DISSOLUTION_DATE => 'dissolution date',
            Corporate::FIELD_REGISTERED_ADDRESS => 'registered address in full',
            Corporate::FIELD_ADDRESS_PK => 1,
            Corporate::FIELD_HISTORIC_NAMES => ['historic name'],
            Corporate::FIELD_NATURE_OF_BUSINESS => ['nature of business'],
            Corporate::FIELD_CORPORATE_FILINGS => ['corporate filings'],
            Corporate::FIELD_OFFICERS => [],
            Corporate::FIELD_NOC_NOT_ADDING_UP => true,
            Corporate::FIELD_PSCS => [],
            Corporate::FIELD_ACTS_AS_PSC => [],
            Corporate::FIELD_LINKED_ADDRESSES => [],
            Corporate::FIELD_CHARGES => [],
            Corporate::FIELD_ICO_REGISTER => [],
            Corporate::FIELD_OWNERSHIP_STRUCTURE => [],
            Corporate::FIELD_PREVIOUS_NAMES => ['previous name'],
            Corporate::FIELD_RETIEVED_AT => 'retrieved at',
            Corporate::FIELD_REGISTRY_URL => 'registry URL',
            Corporate::FIELD_ACCOUNTS_REF_DATE => 'accounts reference date',
            Corporate::FIELD_ACCOUNTS_LAST_UP_DATE => 'last up to date',
            Corporate::FIELD_ANNUAL_RETURN_LAST_UP_DATE => 'annual last up to date',
            Corporate::FIELD_INDUSTRY_CODES => 'industry codes',
            Corporate::FIELD_VAT => [],
            Corporate::FIELD_REQUESTOR => 'requestor'
        ];

        $model = new Corporate($arrData);

        $this->assertEquals($arrData, $model->output());
    }
}