<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\PSCKind;

class PSC extends KonnectAbstract
{
    const FIELD_ADDRESS_PK     = 'AddressPK';
    const FIELD_FIRST_NAME     = 'FirstName';
    const FIELD_MIDDLE_NAMES   = 'MiddleNames';
    const FIELD_LAST_NAME      = 'LastName';
    const FIELD_COMPANY_NUMBER = 'CompanyNumber';
    const FIELD_JURISDICTION   = 'JurisdictionCode';
    const FIELD_KIND           = 'Kind';
    const FIELD_CHPSC_ID       = 'CHPSCId';
    const FIELD_PSC_ID         = 'PSCId';
    const FIELD_NAME           = 'Name';
    const FIELD_DATA           = 'Data';
    const FIELD_DATA_CEASED    = 'CeasedOn';
    const FIELD_PARTIAL_DOB    = 'PartialDateOfBirth';
    const FIELD_DOB            = 'DOB';
    const FIELD_ADDRESS_DATA   = 'AddressData';

    const FIELD_DATA_REASONS = 'Reasons';

    const ADDRESS_DATA_HOUSE_NAME   = 'HouseName';
    const ADDRESS_DATA_HOUSE_NUMBER = 'HouseNumber';
    const ADDRESS_DATA_POSTCODE     = 'Postcode';
    const ADDRESS_DATA_FLAT         = 'Flat';
    const ADDRESS_DATA_STREET       = 'Street';
    const ADDRESS_DATA_CITY         = 'City';
    const ADDRESS_DATA_COUNTY       = 'County';

    const PRIMARY_KEY          = self::FIELD_PSC_ID;

    const FIELDS = [
        self::FIELD_ADDRESS_PK,
        self::FIELD_FIRST_NAME,
        self::FIELD_LAST_NAME,
        self::FIELD_COMPANY_NUMBER,
        self::FIELD_JURISDICTION,
        self::FIELD_KIND,
        self::FIELD_CHPSC_ID,
        self::FIELD_PSC_ID,
        self::FIELD_NAME,
        self::FIELD_DATA,
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

    public function getAddressPK() : ?int
    {
        return $this->_getField(self::FIELD_ADDRESS_PK, null);
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

    public function getCompanyNumber() : ?string
    {
        return $this->_getField(self::FIELD_COMPANY_NUMBER, null);
    }

    public function getJurisdictionCode() : ?string
    {
        return $this->_getField(self::FIELD_JURISDICTION, null);
    }

    public function getKind() : ?PSCKind
    {
        $intKind = $this->_getField(self::FIELD_KIND, null);
        if (empty($intKind)) {
            return null;
        }
        return new PSCKind($intKind);
    }

    public function getCeasedOn() : ?string
    {
        $arrData = $this->getData();

        return $arrData[self::FIELD_DATA_CEASED] ?? null;
    }

    public function getCHPSCId() : ?string
    {
        return $this->_getField(self::FIELD_CHPSC_ID, null);
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
        if (!empty($strMNs)) {
            $strMNs = $this->getMiddleNames().' ';
        }

        return $this->getFirstName().' '.$strMNs.$this->getLastName();
    }

    public function getData() : ?array
    {
        $arrData = $this->_getField(self::FIELD_DATA, null);

        if (isset($arrData[self::FIELD_DATA_REASONS])) {
            foreach ($arrData[self::FIELD_DATA_REASONS] as &$strReason) {
               $strReason = preg_replace('/[\x00-\x1F\x7F]/u', '', $strReason);
            }
        }
        return $arrData;
    }

    public function getPartialDateOfBirth() : ?string
    {
        return $this->_getField(self::FIELD_PARTIAL_DOB, null);
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
        return is_null($this->getCeasedOn());
    }

    public function getKonnectVertexId() : string
    {
        $strJurisdictionCode = $this->getJurisdictionCode();
        $strCompanyNumber = $this->getCompanyNumber();
        $intKind = $this->getKind()->getId();
        $strCHPSCId = $this->getCHPSCId();

        return "p/$strJurisdictionCode,$strCompanyNumber/$intKind/$strCHPSCId";
    }

    public function output() : array
    {
        $intKind  = null;
        if (!is_null($this->getKind())) {
            $intKind = $this->getKind()->getId();
        }

        return [
            self::FIELD_PSC_ID         => $this->getId(),
            self::FIELD_ADDRESS_PK     => $this->getAddressPK(),
            self::FIELD_FIRST_NAME     => $this->getFirstName(),
            self::FIELD_LAST_NAME      => $this->getLastName(),
            self::FIELD_COMPANY_NUMBER => $this->getCompanyNumber(),
            self::FIELD_JURISDICTION   => $this->getJurisdictionCode(),
            self::FIELD_KIND           => $intKind,
            self::FIELD_CHPSC_ID       => $this->getCHPSCId(),
            self::FIELD_NAME           => $this->getName(),
            self::FIELD_DATA           => $this->getData()
        ];
    }

    public function outputEntityData() : array
    {
        $arrEntityData = array_filter(
            [
                self::FIELD_PARTIAL_DOB  => $this->getPartialDateOfBirth(),
                self::FIELD_DOB          => $this->getDOB(),
                self::FIELD_ADDRESS_DATA => $this->getAddressData(),
            ]
        );

        return array_merge(
            $arrEntityData,
            parent::outputEntityData()
        );
    }
}