<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\CorporateStatus as EnumStatus;
use Kompli\Konnect\Iterator\{
    Officers as IttOfficers,
    PSCs as IttPSCs
};

class Corporate extends KonnectAbstract
{
    const FIELD_COMPANY_NUMBER      = 'CompanyNumber';
    const FIELD_JURISDICTION_CODE   = 'JurisdictionCode';
    const FIELD_NAME                = 'Name';
    const FIELD_COMPANY_TYPE        = 'CompanyType';
    const FIELD_CURRENT_STATUS      = 'CurrentStatus';
    const FIELD_INCORPORATION_DATE  = 'IncorporationDate';
    const FIELD_DISSOLUTION_DATE    = 'DissolutionDate';
    const FIELD_REGISTERED_ADDRESS  = 'RegisteredAddressInFull';
    const FIELD_ADDRESS_PK          = 'AddressPK';
    const FIELD_CORPORATE_FILINGS   = 'CorporateFilings';
    const FIELD_OFFICERS            = 'Officers';
    const FIELD_PSCS                = 'PSCs';
    const FIELD_ACTS_AS_PSC         = 'ActsAsPsc';
    const FIELD_LINKED_ADDRESSES    = 'LinkedAddresses';
    const FIELD_CHARGES             = 'Charges';
    const FIELD_CORPORATE_ID        = 'CorporateId';
    const FIELD_OWNERSHIP_STRUCTURE = 'OwnershipStructure';

    const PRIMARY_KEY              = [
        self::FIELD_COMPANY_NUMBER,
        self::FIELD_JURISDICTION_CODE
    ];

    const FIELDS = [
        self::FIELD_COMPANY_NUMBER,
        self::FIELD_JURISDICTION_CODE,
        self::FIELD_NAME,
        self::FIELD_COMPANY_TYPE,
        self::FIELD_CURRENT_STATUS,
        self::FIELD_INCORPORATION_DATE,
        self::FIELD_DISSOLUTION_DATE,
        self::FIELD_REGISTERED_ADDRESS,
        self::FIELD_ADDRESS_PK,
        self::FIELD_CORPORATE_FILINGS,
        self::FIELD_OFFICERS,
        self::FIELD_PSCS,
        self::FIELD_ACTS_AS_PSC,
        self::FIELD_LINKED_ADDRESSES,
        self::FIELD_CHARGES,
        self::FIELD_OWNERSHIP_STRUCTURE
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return self::PRIMARY_KEY;
    }

    public function getCompanyNumber() : ?string
    {
        return $this->_getField(self::FIELD_COMPANY_NUMBER, null);
    }

    public function getCorporateId() : ?string
    {
        return $this->_getField(self::FIELD_CORPORATE_ID, null);
    }

    public function getJurisdictionCode() : ?string
    {
        return $this->_getField(self::FIELD_JURISDICTION_CODE, null);
    }

    public function getName() : ?string
    {
        return $this->_getField(self::FIELD_NAME, null);
    }

    public function getCompanyType() : ?string
    {
        return $this->_getField(self::FIELD_COMPANY_TYPE, null);
    }

    public function getCurrentStatus() : ?EnumStatus
    {
        $strStatus = $this->_getField(self::FIELD_CURRENT_STATUS, null);
        if (empty($strStatus)) {
            return null;
        }
        return new EnumStatus($strStatus);
    }

    public function getIncorporationDate() : ?string
    {
        return $this->_getField(self::FIELD_INCORPORATION_DATE, null);
    }

    public function getDissolutionDate() : ?string
    {
        return $this->_getField(self::FIELD_DISSOLUTION_DATE, null);
    }

    public function getRegisteredAddressInFull() : ?string
    {
        return $this->_getField(self::FIELD_REGISTERED_ADDRESS, null);
    }

    public function getAddressPK() : ?int
    {
        return $this->_getField(self::FIELD_ADDRESS_PK, null);
    }

    public function getCorporateFilings() : array
    {
        return $this->_getField(self::FIELD_CORPORATE_FILINGS, []);
    }

    public function getOfficers() : IttOfficers
    {
        return new IttOfficers($this->_getField(self::FIELD_OFFICERS, []));
    }

    public function getPSCs() : IttPSCs
    {
        return new IttPSCs($this->_getField(self::FIELD_PSCS, []));
    }

    public function getActsAsPsc() : array
    {
        return $this->_getField(self::FIELD_ACTS_AS_PSC, []);
    }

    public function getLinkedAddresses() : array
    {
        return $this->_getField(self::FIELD_LINKED_ADDRESSES, []);
    }

    public function getCharges() : array
    {
        return $this->_getField(self::FIELD_CHARGES, []);
    }

    public function getOwnershipStructure() : array
    {
        return $this->_getField(self::FIELD_OWNERSHIP_STRUCTURE, []);
    }

    public function hasAutoRunFields() : bool
    {
        return (
            !empty($this->getTargetName()) && parent::hasAutoRunFields()
        );
    }

    public function isMissingAllAutoRunFields() : bool
    {
        return (
            is_null($this->getTargetName()) &&
                parent::isMissingAllAutoRunFields()
        );
    }

    public function outputEntityData() : array
    {
        $arrEntityData = array_filter(
            [
                self::FIELD_TARGET_NAME => $this->getTargetName()
            ]
        );

        return array_merge(
            $arrEntityData,
            parent::outputEntityData()
        );
    }
}