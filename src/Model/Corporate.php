<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\CorporateStatus as EnumStatus;
use Kompli\Konnect\Iterator\{
    Officers as IttOfficers,
    PSCs as IttPSCs,
    Corporates as IttCorporates
};

class Corporate extends KonnectAbstract
{
    const FIELD_COMPANY_NUMBER              = 'CompanyNumber';
    const FIELD_JURISDICTION_CODE           = 'JurisdictionCode';
    const FIELD_NAME                        = 'Name';
    const FIELD_COMPANY_TYPE                = 'CompanyType';
    const FIELD_CURRENT_STATUS              = 'CurrentStatus';
    const FIELD_INCORPORATION_DATE          = 'IncorporationDate';
    const FIELD_DISSOLUTION_DATE            = 'DissolutionDate';
    const FIELD_PREVIOUS_NAMES              = 'PreviousNames';
    const FIELD_REGISTRY_URL                = 'RegistryUrl';
    const FIELD_ACCOUNTS_REF_DATE           = 'AccountsReferenceDate';
    const FIELD_ACCOUNTS_LAST_UP_DATE       = 'AccountsLastMadeUpDate';
    const FIELD_ANNUAL_RETURN_LAST_UP_DATE  = 'AnnualReturnLastMadeUpDate';
    const FIELD_INDUSTRY_CODES              = 'IndustryCodes';
    const FIELD_REGISTERED_ADDRESS          = 'RegisteredAddressInFull';
    const FIELD_ADDRESS_PK                  = 'AddressPK';
    const FIELD_HISTORIC_NAMES              = 'HistoricNames';
    const FIELD_NATURE_OF_BUSINESS          = 'NatureOfBusiness';
    const FIELD_CORPORATE_FILINGS           = 'CorporateFilings';
    const FIELD_OFFICERS                    = 'Officers';
    const FIELD_NOC_NOT_ADDING_UP           = 'NoCNotAddingUp';
    const FIELD_PSCS                        = 'PSCs';
    const FIELD_PSC                         = 'PSC';
    const FIELD_ACTS_AS_PSC                 = 'ActsAsPsc';
    const FIELD_LINKED_ADDRESSES            = 'LinkedAddresses';
    const FIELD_CHARGES                     = 'Charges';
    const FIELD_CORPORATE_ID                = 'CorporateId';
    const FIELD_ICO_REGISTER                = 'ICORegisterEntries';
    const FIELD_OWNERSHIP_STRUCTURE         = 'OwnershipStructure';
    const FIELD_VAT                         = 'VAT';
    const FIELD_POSITIONS                   = 'Positions';

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

    public function getHistoricNames() : array
    {
        return $this->_getField(self::FIELD_HISTORIC_NAMES, []);
    }

    public function getNatureOfBusiness() : array
    {
        return $this->_getField(self::FIELD_NATURE_OF_BUSINESS, []);
    }

    public function getCorporateFilings() : array
    {
        return $this->_getField(self::FIELD_CORPORATE_FILINGS, []);
    }

    public function getPreviousNames() : ?array
    {
        return $this->_getField(self::FIELD_PREVIOUS_NAMES, null);
    }

    public function getNocNotAddingUp() : ?bool
    {
        return $this->_getField(self::FIELD_NOC_NOT_ADDING_UP, null);
    }

    public function getRegistryUrl() : ?string
    {
        return $this->_getField(self::FIELD_REGISTRY_URL, null);
    }

    public function getAccountsReferenceDate() : ?string
    {
        return $this->_getField(self::FIELD_ACCOUNTS_REF_DATE, null);
    }

    public function getAccountsLastMadeUpDate() : ?string
    {
        return $this->_getField(self::FIELD_ACCOUNTS_LAST_UP_DATE, null);
    }

    public function getAnnualReturnLastMadeUpDate() : ?string
    {
        return $this->_getField(self::FIELD_ANNUAL_RETURN_LAST_UP_DATE, null);
    }

    public function getIndustryCodes() : ?string
    {
        return $this->_getField(self::FIELD_INDUSTRY_CODES, null);
    }

    public function getVAT() : array
    {
        return $this->_getField(self::FIELD_VAT, []);
    }

    public function getPositions() : array
    {
        return $this->_getField(self::FIELD_POSITIONS, []);
    }

    public function getICORegisterEntries() : array
    {
        return $this->_getField(self::FIELD_ICO_REGISTER, []);
    }

    public function getOfficers() : IttOfficers
    {
        return new IttOfficers($this->_getField(self::FIELD_OFFICERS, []));
    }

    public function getPSCs() : IttPSCs
    {
        return new IttPSCs($this->_getField(self::FIELD_PSCS, []));
    }

    public function getPSC() : array
    {
        return $this->_getField(self::FIELD_PSC, []);
    }

    public function getActsAsPsc() : IttCorporates
    {
        return new IttCorporates(
            $this->_getField(self::FIELD_ACTS_AS_PSC, [])
        );
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

    public function outputActsAsPsc() : array
    {
        $strStatus = null;
        if (!is_null($this->getCurrentStatus())) {
            $strStatus = $this->getCurrentStatus()->getId();
        }

        return [
            self::FIELD_COMPANY_NUMBER      => $this->getCompanyNumber(),
            self::FIELD_JURISDICTION_CODE   => $this->getJurisdictionCode(),
            self::FIELD_NAME                => $this->getName(),
            self::FIELD_COMPANY_TYPE        => $this->getCompanyType(),
            self::FIELD_CURRENT_STATUS      => $strStatus,
            self::FIELD_INCORPORATION_DATE  => $this->getIncorporationDate(),
            self::FIELD_DISSOLUTION_DATE    => $this->getDissolutionDate(),
            self::FIELD_REGISTRY_URL        => $this->getRegistryUrl(),
            self::FIELD_PSC                 => $this->getPSC(),
            self::FIELD_REGISTERED_ADDRESS  =>
                $this->getRegisteredAddressInFull()
        ];
    }

    public function outputOfficer() : array
    {
        $strStatus = null;
        if (!is_null($this->getCurrentStatus())) {
            $strStatus = $this->getCurrentStatus()->getId();
        }

        return [
            self::FIELD_POSITIONS          => $this->getPositions(),
            self::FIELD_KONNECT_ID         => $this->getKonnectId(),
            self::FIELD_CORPORATE_ID       => $this->getCorporateId(),
            self::FIELD_NAME               => $this->getName(),
            self::FIELD_CURRENT_STATUS     => $strStatus,
            self::FIELD_INCORPORATION_DATE => $this->getIncorporationDate(),
            self::FIELD_DISSOLUTION_DATE   => $this->getDissolutionDate(),
        ];
    }

    public function output() : array
    {
        $ittOfficers = $this->getOfficers();
        $ittPSCs = $this->getPSCs();
        $ittCorpActAsPsc = $this->getActsAsPsc();

        $arrOfficers = [];
        foreach ($ittOfficers as $modelOfficer) {
            $arrOfficers[] = $modelOfficer->output();
        }

        $arrPSCs = [];
        foreach ($ittPSCs as $modelPSC) {
            $arrPSCs[] = $modelPSC->output();
        }

        $arrCorpActAsPsc = [];
        foreach ($ittCorpActAsPsc as $modelCorpActAsPsc) {
            $arrCorpActAsPsc[] = $modelCorpActAsPsc->outputActsAsPsc();
        }

        $strStatus = null;
        $enumStatus = $this->getCurrentStatus();

        if (!is_null($enumStatus)) {
            $strStatus = $enumStatus->getId();
        }

        return [
            self::FIELD_KONNECT_ID => $this->getKonnectId(),
            self::FIELD_COMPANY_NUMBER => $this->getCompanyNumber(),
            self::FIELD_JURISDICTION_CODE => $this->getJurisdictionCode(),
            self::FIELD_NAME => $this->getName(),
            self::FIELD_COMPANY_TYPE => $this->getCompanyType(),
            self::FIELD_CURRENT_STATUS => $strStatus,
            self::FIELD_INCORPORATION_DATE => $this->getIncorporationDate(),
            self::FIELD_DISSOLUTION_DATE => $this->getDissolutionDate(),
            self::FIELD_REGISTERED_ADDRESS =>
                $this->getRegisteredAddressInFull(),
            self::FIELD_ADDRESS_PK => $this->getAddressPK(),
            self::FIELD_HISTORIC_NAMES => $this->getHistoricNames(),
            self::FIELD_NATURE_OF_BUSINESS => $this->getNatureOfBusiness(),
            self::FIELD_CORPORATE_FILINGS => $this->getCorporateFilings(),
            self::FIELD_OFFICERS => $arrOfficers,
            self::FIELD_NOC_NOT_ADDING_UP => $this->getNocNotAddingUp(),
            self::FIELD_PSCS => $arrPSCs,
            self::FIELD_ACTS_AS_PSC => $arrCorpActAsPsc,
            self::FIELD_LINKED_ADDRESSES => $this->getLinkedAddresses(),
            self::FIELD_CHARGES => $this->getCharges(),
            self::FIELD_ICO_REGISTER => $this->getICORegisterEntries(),
            self::FIELD_OWNERSHIP_STRUCTURE => $this->getOwnershipStructure(),
            self::FIELD_PREVIOUS_NAMES => $this->getPreviousNames(),
            self::FIELD_RETIEVED_AT => $this->getRetrievedAt(),
            self::FIELD_REGISTRY_URL => $this->getRegistryUrl(),
            self::FIELD_ACCOUNTS_REF_DATE =>
                $this->getAccountsReferenceDate(),
            self::FIELD_ACCOUNTS_LAST_UP_DATE =>
                $this->getAccountsLastMadeUpDate(),
            self::FIELD_ANNUAL_RETURN_LAST_UP_DATE =>
                $this->getAnnualReturnLastMadeUpDate(),
            self::FIELD_INDUSTRY_CODES => $this->getIndustryCodes(),
            self::FIELD_VAT => $this->getVAT(),
            self::FIELD_REQUESTOR => $this->getRequestor(),
        ];
    }
}