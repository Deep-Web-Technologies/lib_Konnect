<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\BitFlags\OfficerRole;
use Kompli\Konnect\Helper\Enum\OfficerType;
use Kompli\Konnect\Helper\Enum\QEDProductSendType;
use PHPUnit\Framework\TestCase;

class OfficerTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            'Id',
            'Name',
            'FirstName',
            'LastName',
            'OfficerRole',
            'Position',
            'StartDate',
            'EndDate',
            'Nationality',
            'PartialDateOfBirth',
            'AddressPK',
            'Type',
            'OfficerClusterRootId',
            'AddressInFull',
            Officer::FIELD_PREVIOUS_NAMES
        ];

        $this->assertEquals($arrFields, Officer::getFields());
    }

    public function testGetters()
    {
        $fieldPrimaryKey         = Officer::FIELD_ID;
        $strName                 = 'testName';
        $strFirstName            = 'testFirst';
        $strLastName             = 'testLast';
        $intOfficerRole          = OfficerRole::TYPE_DIRECTOR;
        $strPosition             = 'testPos';
        $strStartDate            = 'testStart';
        $strEndDate              = 'testEnd';
        $strNationality          = 'testNationality';
        $strPartialDateOfBirth   = 'testPartial';
        $intAddressPK            = 2;
        $strType                 = OfficerType::TYPE_PERSON;
        $intOfficerClusterRootId = 3;
        $strAddressInFull        = 'testAddress';
        $arrPreviousNames        = ['previous name'];

        $arrOfficerData = [
            Officer::PRIMARY_KEY        => $fieldPrimaryKey,
            Officer::FIELD_NAME         => $strName,
            Officer::FIELD_FIRST_NAME   => $strFirstName,
            Officer::FIELD_LAST_NAME    => $strLastName,
            Officer::FIELD_OFFICER_ROLE => $intOfficerRole,
            Officer::FIELD_POSITION     => $strPosition,
            Officer::FIELD_START_DATE   => $strStartDate,
            Officer::FIELD_END_DATE     => $strEndDate,
            Officer::FIELD_NATIONALITY  => $strNationality,
            Officer::FIELD_PARTIAL_DOB  => $strPartialDateOfBirth,
            Officer::FIELD_ADDRESS_PK   => $intAddressPK,
            Officer::FIELD_TYPE         => $strType,
            Officer::FIELD_OCR_ID       => $intOfficerClusterRootId,
            Officer::FIELD_ADDRESS      => $strAddressInFull,
            Officer::FIELD_PREVIOUS_NAMES => $arrPreviousNames,
            Officer::FIELD_COMPANY_AGENT_CLUSTER_ID => 1,
            Officer::FIELD_KONNECT_ID => 'KonnectId'

        ];

        $modelOfficer = new Officer($arrOfficerData);

        $arrGetters = [
            Officer::PRIMARY_KEY        => $modelOfficer->getPrimaryKey(),
            Officer::FIELD_NAME         => $modelOfficer->getName(),
            Officer::FIELD_FIRST_NAME   => $modelOfficer->getFirstName(),
            Officer::FIELD_LAST_NAME    => $modelOfficer->getLastName(),
            Officer::FIELD_OFFICER_ROLE => $modelOfficer->getOfficerRole()->getBitCollection(),
            Officer::FIELD_POSITION     => $modelOfficer->getPosition(),
            Officer::FIELD_START_DATE   => $modelOfficer->getStartDate(),
            Officer::FIELD_END_DATE     => $modelOfficer->getEndDate(),
            Officer::FIELD_NATIONALITY  => $modelOfficer->getNationality(),
            Officer::FIELD_PARTIAL_DOB  => $modelOfficer->getPartialDateOfBirth(),
            Officer::FIELD_ADDRESS_PK   => $modelOfficer->getAddressPK(),
            Officer::FIELD_TYPE         => $modelOfficer->getType()->getId(),
            Officer::FIELD_OCR_ID       => $modelOfficer->getOfficerClusterRootId(),
            Officer::FIELD_ADDRESS      => $modelOfficer->getAddressInFull(),
            Officer::FIELD_PREVIOUS_NAMES => $modelOfficer->getPreviousNames(),
            Officer::FIELD_COMPANY_AGENT_CLUSTER_ID => $modelOfficer->getCompanyFormationAgentId(),
            Officer::FIELD_KONNECT_ID => $modelOfficer->getKonnectId(),
        ];

        $this->assertEquals($arrOfficerData, $arrGetters);
        $this->assertFalse($modelOfficer->isActive());
        $this->assertFalse($modelOfficer->isCompany());
    }

    public function testOutput()
    {
        $intId                   = 1;
        $strName                 = 'testName';
        $strFirstName            = 'testFirst';
        $strLastName             = 'testLast';
        $intOfficerRole          = OfficerRole::TYPE_DIRECTOR;
        $strPosition             = 'testPos';
        $strStartDate            = 'testStart';
        $strEndDate              = 'testEnd';
        $strNationality          = 'testNationality';
        $strPartialDateOfBirth   = 'testPartial';
        $intAddressPK            = 2;
        $strType                 = OfficerType::TYPE_PERSON;
        $intOfficerClusterRootId = 3;
        $strAddressInFull        = 'testAddress';
        $intCompanyFormationAgentId = 1;
        $strKonnectId = 'KonnectId';
        $arrPreviousNames = ['previous names'];

        $arrOfficerData = [
            Officer::FIELD_ID           => $intId,
            Officer::FIELD_NAME         => $strName,
            Officer::FIELD_FIRST_NAME   => $strFirstName,
            Officer::FIELD_LAST_NAME    => $strLastName,
            Officer::FIELD_OFFICER_ROLE => $intOfficerRole,
            Officer::FIELD_POSITION     => $strPosition,
            Officer::FIELD_START_DATE   => $strStartDate,
            Officer::FIELD_END_DATE     => $strEndDate,
            Officer::FIELD_NATIONALITY  => $strNationality,
            Officer::FIELD_PARTIAL_DOB  => $strPartialDateOfBirth,
            Officer::FIELD_ADDRESS_PK   => $intAddressPK,
            Officer::FIELD_TYPE         => $strType,
            Officer::FIELD_OCR_ID       => $intOfficerClusterRootId,
            Officer::FIELD_ADDRESS      => $strAddressInFull,
            Officer::FIELD_COMPANY_AGENT_CLUSTER_ID => $intCompanyFormationAgentId,
            Officer::FIELD_KONNECT_ID => $strKonnectId,
            Officer::FIELD_PREVIOUS_NAMES => $arrPreviousNames,
        ];

        $modelOfficer = new Officer($arrOfficerData);

        $this->assertEquals($arrOfficerData, $modelOfficer->output());
    }

    public function testOutputEntityData()
    {
        $arrData = [
            Officer::FIELD_ADDRESS => 'Address',
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
