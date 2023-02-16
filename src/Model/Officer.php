<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\BitFlags\OfficerRole;
use Kompli\Konnect\Helper\Enum\OfficerType;
use Exception;
use Kompli\Konnect\Iterator\{
    Corporates as IttCorporates,
    PSCs as IttPSCs,
    Addresses as IttAddresses
};
use Kompli\Konnect\Model\Address as ModelAddress;

class Officer extends KonnectAbstract
{
    const FIELD_ID                         = 'Id';
    const FIELD_TITLE                      = 'Title';
    const FIELD_NAME                       = 'Name';
    const FIELD_FIRST_NAME                 = 'FirstName';
    const FIELD_MIDDLE_NAMES               = 'MiddleNames';
    const FIELD_LAST_NAME                  = 'LastName';
    const FIELD_OFFICER_ROLE               = 'OfficerRole';
    const FIELD_POSITION                   = 'Position';
    const FIELD_OCCUPATION                 = 'Occupation';
    const FIELD_START_DATE                 = 'StartDate';
    const FIELD_END_DATE                   = 'EndDate';
    const FIELD_NATIONALITY                = 'Nationality';
    const FIELD_PARTIAL_DOB                = 'PartialDateOfBirth';
    const FIELD_ADDRESS_PK                 = 'AddressPK';
    const FIELD_TYPE                       = 'Type';
    const FIELD_OCR_ID                     = 'OfficerClusterRootId';
    const FIELD_ADDRESS_IN_FULL            = 'AddressInFull';
    const FIELD_PREVIOUS_NAMES             = 'PreviousNames';
    const FIELD_COMPANY_AGENT_CLUSTER_ID   = 'CompanyFormationAgentClusterId';
    const FIELD_COMPANY_AGENT_CLUSTER_SIZE = 'CompanyFormationAgentClusterSize';
    const FIELD_COUNTRY_OF_RESIDENCE       = 'CountryOfResidence';
    const FIELD_ADDRESS                    = 'Address';
    const FIELD_OTHER_NAMES                = 'OtherNames';
    const FIELD_OTHER_DOB                  = 'OtherDoB';
    const FIELD_OTHER_OCCUPATIONS          = 'OtherOccupations';
    const FIELD_OTHER_NATIONALITIES        = 'OtherNationalities';
    const FIELD_OTHER_POSITIONS            = 'OtherPositions';
    const FIELD_CURRENT_ADDRESSES          = 'CurrentAddresses';
    const FIELD_ULT_OWNERSHIP_STRUCT       = 'UltimateOwnershipStructure';
    const FIELD_CORP_APPOINTMENT           = 'FirstCorporateAppointment';
    const FIELD_CORPORATES                 = 'Corporates';
    const FIELD_ACTS_AS_PSC                = 'ActsAsPsc';
    const FIELD_LINKED_ADDRESSES           = 'LinkedAddresses';
    const FIELD_DOB                        = 'DOB';
    const FIELD_ADDRESS_DATA               = 'AddressData';

    const ADDRESS_DATA_HOUSE_NAME          = 'HouseName';
    const ADDRESS_DATA_HOUSE_NUMBER        = 'HouseNumber';
    const ADDRESS_DATA_POSTCODE            = 'Postcode';
    const ADDRESS_DATA_FLAT                = 'Flat';
    const ADDRESS_DATA_STREET              = 'Street';
    const ADDRESS_DATA_CITY                = 'City';
    const ADDRESS_DATA_COUNTY              = 'County';

    const PRIMARY_KEY        = self::FIELD_ID;

    const FIELDS = [
        self::FIELD_ID,
        self::FIELD_TITLE,
        self::FIELD_NAME,
        self::FIELD_FIRST_NAME,
        self::FIELD_LAST_NAME,
        self::FIELD_OFFICER_ROLE,
        self::FIELD_POSITION,
        self::FIELD_START_DATE,
        self::FIELD_END_DATE,
        self::FIELD_NATIONALITY,
        self::FIELD_PARTIAL_DOB,
        self::FIELD_ADDRESS_PK,
        self::FIELD_TYPE,
        self::FIELD_OCR_ID,
        self::FIELD_ADDRESS_IN_FULL,
        self::FIELD_PREVIOUS_NAMES,
        self::FIELD_ADDRESS,
        self::FIELD_OTHER_NAMES,
        self::FIELD_OTHER_DOB,
        self::FIELD_OTHER_OCCUPATIONS,
        self::FIELD_OTHER_NATIONALITIES,
        self::FIELD_OTHER_POSITIONS,
        self::FIELD_CORP_APPOINTMENT,
        self::FIELD_ACTS_AS_PSC,
        self::FIELD_DOB,
        self::FIELD_ADDRESS_DATA,
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return self::PRIMARY_KEY;
    }

    public function getId()
    {
        return $this->_getField(self::FIELD_ID, null);
    }

    public function getKonnectId() : ?string
    {
        return $this->_getField(self::FIELD_KONNECT_ID, null);
    }

    public function getTitle() : ?string
    {
        return $this->_getField(self::FIELD_TITLE, null);
    }

    public function getName() : ?string
    {
        if (
            empty($this->getFirstName()) ||
            empty($this->getLastName())
        ) {
            $this->_getField(self::FIELD_NAME, null);
        }

        $strMNs = '';
        if (!empty($this->getMiddleNames())) {
            $strMNs = $this->getMiddleNames().' ';
        }

        return $this->getFirstName().' '.$strMNs.$this->getLastName();
    }

    public function getFirstName() : ?string
    {
        $strName = $this->_getField(self::FIELD_NAME, null);
        $strFN   = $this->_getField(self::FIELD_FIRST_NAME, null);

        if (empty($strFN) && !empty($strName)) {
            $arrNameParts = explode(' ', $strName);
            return $arrNameParts[0];
        }
        return $strFN;
    }

    public function getMiddleNames() : ?string
    {
        $strName = $this->_getField(self::FIELD_NAME, null);
        $strMNs  = $this->_getField(self::FIELD_MIDDLE_NAMES, null);

        if (empty($strMNs) && !empty($strName)) {
            $arrNameParts   = explode(' ', $strName);
            $arrMiddleNames = array_slice($arrNameParts, 1, -1);
            if (empty($arrMiddleNames)) {
                return null;
            }
            return implode(' ', $arrMiddleNames);
        }
        return $strMNs;
    }

    public function getLastName() : ?string
    {
        $strName = $this->_getField(self::FIELD_NAME, null);
        $strLN   = $this->_getField(self::FIELD_LAST_NAME, null);

        if (empty($strLN) && !empty($strName)) {
            $arrNameParts = explode(' ', $strName);
            return array_pop($arrNameParts);
        }
        return $strLN;
    }

    public function getOfficerRole() : ?OfficerRole
    {
        $intOfficerRole = $this->_getField(self::FIELD_OFFICER_ROLE, null);
        if (empty($intOfficerRole)) {
            return null;
        }
        return new OfficerRole($intOfficerRole);
    }

    public function getPosition() : ?string
    {
        return $this->_getField(self::FIELD_POSITION, null);
    }

    public function getOccupation() : ?string
    {
        return $this->_getField(self::FIELD_OCCUPATION, null);
    }

    public function getAddress() : ModelAddress
    {
        return new ModelAddress($this->_getField(self::FIELD_ADDRESS, []));
    }

    public function getCorporates() : IttCorporates
    {
        return new IttCorporates(
            $this->_getField(self::FIELD_CORPORATES, [])
        );
    }
    public function getLinkedAddresses() : IttAddresses
    {
        return new IttAddresses(
            $this->_getField(self::FIELD_LINKED_ADDRESSES, [])
        );
    }

    public function getStartDate() : ?string
    {
        return $this->_getField(self::FIELD_START_DATE, null);
    }

    public function getEndDate() : ?string
    {
        return $this->_getField(self::FIELD_END_DATE, null);
    }

    public function getNationality() : ?string
    {
        return $this->_getField(self::FIELD_NATIONALITY, null);
    }

    public function getCountryOfResidence() : ?string
    {
        return $this->_getField(self::FIELD_COUNTRY_OF_RESIDENCE, null);
    }

    public function getPartialDateOfBirth() : ?string
    {
        return $this->_getField(self::FIELD_PARTIAL_DOB, null);
    }

    public function getAddressPK() : ?int
    {
        return $this->_getField(self::FIELD_ADDRESS_PK, null);
    }

    public function getType() : ?OfficerType
    {
        $strType = $this->_getField(self::FIELD_TYPE, null);
        if (empty($strType)) {
            return null;
        }
        return new OfficerType($strType);
    }

    public function getOfficerClusterRootId() : ?int
    {
        return $this->_getField(self::FIELD_OCR_ID, null);
    }

    public function getAddressInFull() : ?string
    {
        return $this->_getField(self::FIELD_ADDRESS_IN_FULL, null);
    }

    public function getCompanyFormationAgentId() : ?int
    {
        return $this->_getField(self::FIELD_COMPANY_AGENT_CLUSTER_ID, null);
    }

    public function getCompanyFormationAgentClusterSize() : ?int
    {
        return $this->_getField(self::FIELD_COMPANY_AGENT_CLUSTER_SIZE, null);
    }

    public function getPreviousNames() : array
    {
        return $this->_getField(self::FIELD_PREVIOUS_NAMES, []);
    }

    public function getOtherNames() : array
    {
        return $this->_getField(self::FIELD_OTHER_NAMES, []);
    }

    public function getOtherDoB() : array
    {
        return $this->_getField(self::FIELD_OTHER_DOB, []);
    }

    public function getOtherOccupations() : array
    {
        return $this->_getField(self::FIELD_OTHER_OCCUPATIONS, []);
    }

    public function getOtherNationalities() : array
    {
        return $this->_getField(self::FIELD_OTHER_NATIONALITIES, []);
    }

    public function getFirstCorporateAppointment() : array
    {
        return $this->_getField(self::FIELD_CORP_APPOINTMENT, []);
    }

    public function getOtherPositions() : array
    {
        return $this->_getField(self::FIELD_OTHER_POSITIONS, []);
    }

    public function getActsAsPsc() : IttCorporates
    {
        return new IttCorporates(
            $this->_getField(self::FIELD_ACTS_AS_PSC, [])
        );
    }

    public function getCurrentAddresses() : array
    {
        return $this->_getField(self::FIELD_CURRENT_ADDRESSES, []);
    }

    public function getUltimateOwnershipStructure() : array
    {
        return $this->_getField(self::FIELD_ULT_OWNERSHIP_STRUCT, []);
    }

    public function getDOB() : ?string
    {
        return $this->_getField(self::FIELD_DOB, null);
    }

    public function getAddressData() : array
    {
        return $this->_getField(self::FIELD_ADDRESS_DATA, []);
    }

    public function getAddressHouseName() : ?string
    {
        return $this->getAddressData()[self::ADDRESS_DATA_HOUSE_NAME] ?? null;
    }
    public function getAddressHouseNumber() : ?int
    {
        return $this->getAddressData()[self::ADDRESS_DATA_HOUSE_NUMBER] ?? null;
    }
    public function getAddressPostcode() : ?string
    {
        return $this->getAddressData()[self::ADDRESS_DATA_POSTCODE] ?? null;
    }
    public function getAddressFlat() : ?string
    {
        return $this->getAddressData()[self::ADDRESS_DATA_FLAT] ?? null;
    }
    public function getAddressStreet() : ?string
    {
        return $this->getAddressData()[self::ADDRESS_DATA_STREET] ?? null;
    }
    public function getAddressCity() : ?string
    {
        return $this->getAddressData()[self::ADDRESS_DATA_CITY] ?? null;
    }
    public function getAddressCounty() : ?string
    {
        return $this->getAddressData()[self::ADDRESS_DATA_COUNTY] ?? null;
    }

    public function isActive() : bool
    {
        return (
            empty($this->getEndDate()) ||
                $this->getEndDate() === '0000-00-00'
        );
    }

    public function isCompany() : bool
    {
        $enumType = $this->getType();

        if (
            is_null($enumType) ||
            !in_array($enumType->getId(), OfficerType::getAllowedValues())
        ) {
            throw new Exception(
                $this->getName() . ' has an invalid value for ' .
                    self::FIELD_TYPE
            );
        }

        return $this->getType()->isCompany();
    }

    public function output() : array
    {
        $ittCorporates = $this->getCorporates();
        $ittCorpActAsPsc = $this->getActsAsPsc();
        $ittLinkedAddresses = $this->getLinkedAddresses();

        $arrCorporates = [];
        foreach ($ittCorporates as $modelCorporate) {
            $arrCorporates[] = $modelCorporate->outputOfficer();
        }
        $arrCorpActAsPsc = [];
        foreach ($ittCorpActAsPsc as $modelCorpActAsPsc) {
            $arrCorpActAsPsc[] = $modelCorpActAsPsc->outputActsAsPsc();
        }
        $arrLinkedAddresses = [];
        foreach ($ittLinkedAddresses as $modelLinkedAddresses) {
            $arrLinkedAddresses[] = $modelLinkedAddresses->outputLinked();
        }

        $bitRole = $this->getOfficerRole();
        $intRole = null;
        if (!is_null($bitRole)) {
            $intRole = $bitRole->getBitCollection();
        }

        $strType = null;
        if (!is_null($this->getType())) {
            $strType = $this->getType()->getId();
        }

        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_KONNECT_ID => $this->getKonnectId(),
            self::FIELD_TITLE => $this->getTitle(),
            self::FIELD_NAME => $this->getName(),
            self::FIELD_FIRST_NAME => $this->getFirstName(),
            self::FIELD_LAST_NAME => $this->getLastName(),
            self::FIELD_PREVIOUS_NAMES => $this->getPreviousNames(),
            self::FIELD_OFFICER_ROLE => $intRole,
            self::FIELD_POSITION => $this->getPosition(),
            self::FIELD_OCCUPATION => $this->getOccupation(),
            self::FIELD_START_DATE => $this->getStartDate(),
            self::FIELD_END_DATE => $this->getEndDate(),
            self::FIELD_NATIONALITY => $this->getNationality(),
            self::FIELD_COUNTRY_OF_RESIDENCE => $this->getCountryOfResidence(),
            self::FIELD_PARTIAL_DOB => $this->getPartialDateOfBirth(),
            self::FIELD_ADDRESS_PK => $this->getAddressPK(),
            self::FIELD_TYPE => $strType,
            self::FIELD_OCR_ID => $this->getOfficerClusterRootId(),
            self::FIELD_ADDRESS_IN_FULL => $this->getAddressInFull(),
            self::FIELD_RETIEVED_AT => $this->getRetrievedAt(),
            self::FIELD_COMPANY_AGENT_CLUSTER_ID =>
                $this->getCompanyFormationAgentId(),
            self::FIELD_COMPANY_AGENT_CLUSTER_SIZE =>
                $this->getCompanyFormationAgentClusterSize(),
            self::FIELD_OTHER_NAMES => $this->getOtherNames(),
            self::FIELD_ADDRESS => $this->getAddress()->outputOfficer(),
            self::FIELD_OTHER_DOB => $this->getOtherDoB(),
            self::FIELD_OTHER_OCCUPATIONS => $this->getOtherOccupations(),
            self::FIELD_OTHER_NATIONALITIES => $this->getOtherNationalities(),
            self::FIELD_CORP_APPOINTMENT =>
                $this->getFirstCorporateAppointment(),
            self::FIELD_CORPORATES => $arrCorporates,
            self::FIELD_OTHER_POSITIONS => $this->getOtherPositions(),
            self::FIELD_ACTS_AS_PSC => $arrCorpActAsPsc,
            self::FIELD_LINKED_ADDRESSES => $arrLinkedAddresses,
            self::FIELD_CURRENT_ADDRESSES => $this->getCurrentAddresses(),
            self::FIELD_ULT_OWNERSHIP_STRUCT =>
                $this->getUltimateOwnershipStructure(),
            self::FIELD_REQUESTOR => $this->getRequestor()
        ];
    }

    public function outputEntityData() : array
    {
        $arrEntityData = array_filter(
            [
                self::FIELD_ADDRESS_IN_FULL => $this->getAddressInFull(),
                self::FIELD_PARTIAL_DOB     => $this->getPartialDateOfBirth(),
                self::FIELD_PREVIOUS_NAMES  => $this->getPreviousNames(),
                self::FIELD_DOB             => $this->getDOB(),
                self::FIELD_ADDRESS_DATA    => $this->getAddressData(),
            ]
        );

        return array_merge(
            $arrEntityData,
            parent::outputEntityData()
        );
    }
}