<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Iterator\{
    Corporates as IttCorporates,
    PSCs as IttPSCs,
    Addresses as IttAddresses
};
use Kompli\Konnect\Helper\Enum\QEDProductSendType;
use PHPUnit\Framework\TestCase;

class OfficerTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            Officer::FIELD_ID,
            Officer::FIELD_TITLE,
            Officer::FIELD_NAME,
            Officer::FIELD_FIRST_NAME,
            Officer::FIELD_LAST_NAME,
            Officer::FIELD_OFFICER_ROLE,
            Officer::FIELD_POSITION,
            Officer::FIELD_START_DATE,
            Officer::FIELD_END_DATE,
            Officer::FIELD_NATIONALITY,
            Officer::FIELD_PARTIAL_DOB,
            Officer::FIELD_ADDRESS_PK,
            Officer::FIELD_TYPE,
            Officer::FIELD_OCR_ID,
            Officer::FIELD_ADDRESS_IN_FULL,
            Officer::FIELD_PREVIOUS_NAMES,
            Officer::FIELD_ADDRESS,
            Officer::FIELD_OTHER_NAMES,
            Officer::FIELD_OTHER_DOB,
            Officer::FIELD_OTHER_OCCUPATIONS,
            Officer::FIELD_OTHER_NATIONALITIES,
            Officer::FIELD_OTHER_POSITIONS,
            Officer::FIELD_CORP_APPOINTMENT,
            Officer::FIELD_ACTS_AS_PSC,
        ];

        $this->assertEquals($arrFields, Officer::getFields());
    }

    public function testGetters()
    {
        $arrAddress = [
            Address::FIELD_POST_CODE => 'postcode',
            Address::FIELD_COUNTRY => 'country',
            Address::FIELD_LAT => 'latitude',
            Address::FIELD_LONG => 'longitude',
            Address::FIELD_STREET_ADDRESS => 'street address',
            Address::FIELD_LOCALITY => 'locality',
            Address::FIELD_REGION => 'region'
        ];

        $arrOfficerData = [
            Officer::PRIMARY_KEY => Officer::FIELD_ID,
            Officer::FIELD_KONNECT_ID => 'KonnectId',
            Officer::FIELD_ID => 1,
            Officer::FIELD_TITLE => 'title',
            Officer::FIELD_NAME => 'name',
            Officer::FIELD_FIRST_NAME => 'first name',
            Officer::FIELD_LAST_NAME => 'last name',
            Officer::FIELD_OFFICER_ROLE => 2,
            Officer::FIELD_POSITION => 'position',
            Officer::FIELD_OCCUPATION => 'occupation',
            Officer::FIELD_COUNTRY_OF_RESIDENCE => 'country of residence',
            Officer::FIELD_START_DATE => 'start date',
            Officer::FIELD_END_DATE => 'end date',
            Officer::FIELD_NATIONALITY => 'nationality',
            Officer::FIELD_PARTIAL_DOB => 'partial DOB',
            Officer::FIELD_ADDRESS_PK => 3,
            Officer::FIELD_TYPE => 'Person',
            Officer::FIELD_OCR_ID => 4,
            Officer::FIELD_ADDRESS_IN_FULL => 'address in full',
            Officer::FIELD_PREVIOUS_NAMES => ['previous name'],
            Officer::FIELD_ADDRESS => $arrAddress,
            Officer::FIELD_OTHER_NAMES => ['other name'],
            Officer::FIELD_OTHER_DOB => ['other DOB'],
            Officer::FIELD_OTHER_OCCUPATIONS => ['other occupation'],
            Officer::FIELD_OTHER_NATIONALITIES => ['other nationality'],
            Officer::FIELD_OTHER_POSITIONS => ['other position'],
            Officer::FIELD_CORP_APPOINTMENT => ['first corporate appointment'],
            Officer::FIELD_CURRENT_ADDRESSES => ['current address'],
            Officer::FIELD_ULT_OWNERSHIP_STRUCT => ['ownership'],
            Officer::FIELD_COMPANY_AGENT_CLUSTER_ID => 5,
            Officer::FIELD_COMPANY_AGENT_CLUSTER_SIZE => 6,
            Officer::FIELD_REQUESTOR => 'requestor'
        ];

        $modelOfficer = new Officer($arrOfficerData);

        $arrGetters = [
            Officer::PRIMARY_KEY => $modelOfficer->getPrimaryKey(),
            Officer::FIELD_ID => $modelOfficer->getId(),
            Officer::FIELD_KONNECT_ID => $modelOfficer->getKonnectId(),
            Officer::FIELD_TITLE => $modelOfficer->getTitle(),
            Officer::FIELD_NAME => $modelOfficer->getName(),
            Officer::FIELD_FIRST_NAME => $modelOfficer->getFirstName(),
            Officer::FIELD_LAST_NAME => $modelOfficer->getLastName(),
            Officer::FIELD_OFFICER_ROLE =>
                $modelOfficer->getOfficerRole()->getBitCollection(),
            Officer::FIELD_POSITION => $modelOfficer->getPosition(),
            Officer::FIELD_OCCUPATION => $modelOfficer->getOccupation(),
            Officer::FIELD_ADDRESS => $modelOfficer->getAddress()->outputOfficer(),
            Officer::FIELD_START_DATE => $modelOfficer->getStartDate(),
            Officer::FIELD_END_DATE => $modelOfficer->getEndDate(),
            Officer::FIELD_NATIONALITY => $modelOfficer->getNationality(),
            Officer::FIELD_COUNTRY_OF_RESIDENCE => $modelOfficer->getCountryOfResidence(),
            Officer::FIELD_PARTIAL_DOB => $modelOfficer->getPartialDateOfBirth(),
            Officer::FIELD_ADDRESS_PK => $modelOfficer->getAddressPK(),
            Officer::FIELD_TYPE => $modelOfficer->getType()->getId(),
            Officer::FIELD_OCR_ID => $modelOfficer->getOfficerClusterRootId(),
            Officer::FIELD_ADDRESS_IN_FULL => $modelOfficer->getAddressInFull(),
            Officer::FIELD_COMPANY_AGENT_CLUSTER_ID => $modelOfficer->getCompanyFormationAgentId(),
            Officer::FIELD_COMPANY_AGENT_CLUSTER_SIZE =>
                $modelOfficer->getCompanyFormationAgentClusterSize(),
            Officer::FIELD_PREVIOUS_NAMES => $modelOfficer->getPreviousNames(),
            Officer::FIELD_OTHER_NAMES => $modelOfficer->getOtherNames(),
            Officer::FIELD_OTHER_DOB => $modelOfficer->getOtherDoB(),
            Officer::FIELD_OTHER_OCCUPATIONS => $modelOfficer->getOtherOccupations(),
            Officer::FIELD_OTHER_NATIONALITIES => $modelOfficer->getOtherNationalities(),
            Officer::FIELD_CORP_APPOINTMENT => $modelOfficer->getFirstCorporateAppointment(),
            Officer::FIELD_OTHER_POSITIONS => $modelOfficer->getOtherPositions(),
            Officer::FIELD_CURRENT_ADDRESSES => $modelOfficer->getCurrentAddresses(),
            Officer::FIELD_ULT_OWNERSHIP_STRUCT => $modelOfficer->getUltimateOwnershipStructure(),
            Officer::FIELD_REQUESTOR => $modelOfficer->getRequestor()
        ];

        $this->assertEquals($arrOfficerData, $arrGetters);
        $this->assertFalse($modelOfficer->isActive());
        $this->assertFalse($modelOfficer->isCompany());
        $this->assertTrue($modelOfficer->getCorporates() instanceof IttCorporates);
        $this->assertTrue($modelOfficer->getLinkedAddresses() instanceof IttAddresses);
        $this->assertTrue($modelOfficer->getActsAsPsc() instanceof IttCorporates);
    }

    public function testOutput()
    {
        $arrAddress = [
            Address::FIELD_POST_CODE => 'postcode',
            Address::FIELD_COUNTRY => 'country',
            Address::FIELD_LAT => 'latitude',
            Address::FIELD_LONG => 'longitude',
            Address::FIELD_STREET_ADDRESS => 'street address',
            Address::FIELD_LOCALITY => 'locality',
            Address::FIELD_REGION => 'region'
        ];

        $arrOfficerData = [
            Officer::PRIMARY_KEY => Officer::FIELD_ID,
            Officer::FIELD_KONNECT_ID => 'KonnectId',
            Officer::FIELD_ID => 1,
            Officer::FIELD_TITLE => 'title',
            Officer::FIELD_NAME => 'name',
            Officer::FIELD_FIRST_NAME => 'first name',
            Officer::FIELD_LAST_NAME => 'last name',
            Officer::FIELD_OFFICER_ROLE => 2,
            Officer::FIELD_POSITION => 'position',
            Officer::FIELD_OCCUPATION => 'occupation',
            Officer::FIELD_COUNTRY_OF_RESIDENCE => 'country of residence',
            Officer::FIELD_START_DATE => 'start date',
            Officer::FIELD_END_DATE => 'end date',
            Officer::FIELD_NATIONALITY => 'nationality',
            Officer::FIELD_PARTIAL_DOB => 'partial DOB',
            Officer::FIELD_ADDRESS_PK => 3,
            Officer::FIELD_TYPE => 'Person',
            Officer::FIELD_OCR_ID => 4,
            Officer::FIELD_ADDRESS_IN_FULL => 'address in full',
            Officer::FIELD_PREVIOUS_NAMES => ['previous name'],
            Officer::FIELD_ADDRESS => $arrAddress,
            Officer::FIELD_OTHER_NAMES => ['other name'],
            Officer::FIELD_OTHER_DOB => ['other DOB'],
            Officer::FIELD_OTHER_OCCUPATIONS => ['other occupation'],
            Officer::FIELD_OTHER_NATIONALITIES => ['other nationality'],
            Officer::FIELD_OTHER_POSITIONS => ['other position'],
            Officer::FIELD_CORP_APPOINTMENT => ['first corporate appointment'],
            Officer::FIELD_CURRENT_ADDRESSES => ['current address'],
            Officer::FIELD_ULT_OWNERSHIP_STRUCT => ['ownership'],
            Officer::FIELD_COMPANY_AGENT_CLUSTER_ID => 5,
            Officer::FIELD_COMPANY_AGENT_CLUSTER_SIZE => 6,
            Officer::FIELD_RETIEVED_AT => 'retrieved at',
            Officer::FIELD_REQUESTOR => 'requestor',
            Officer::FIELD_CORPORATES => [],
            Officer::FIELD_ACTS_AS_PSC => [],
            Officer::FIELD_LINKED_ADDRESSES => [],
        ];

        $modelOfficer = new Officer($arrOfficerData);

        $this->assertEquals($arrOfficerData, $modelOfficer->output());
    }

    public function testOutputEntityData()
    {
        $arrData = [
            Officer::FIELD_ADDRESS_IN_FULL => 'Address',
            Officer::FIELD_PARTIAL_DOB => '2000-01-01',
            Officer::FIELD_PREVIOUS_NAMES => ['Previous Name'],
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
