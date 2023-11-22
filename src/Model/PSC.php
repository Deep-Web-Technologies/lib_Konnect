<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\PSCKind;

class PSC extends KonnectAbstract
{
    const FIELD_ADDRESS_PK     = 'AddressPK';
    const FIELD_FIRST_NAME     = 'FirstName';
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

    const FIELD_DATA_REASONS = 'Reasons';

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
        self::FIELD_DATA
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
        return $this->_getField(self::FIELD_PSC_ID, null) ??
            $this->getKonnectId();
    }

    public function getAddressPK() : ?int
    {
        return $this->_getField(self::FIELD_ADDRESS_PK, null);
    }

    public function getFirstName() : ?string
    {
        return $this->_getField(self::FIELD_FIRST_NAME, null);
    }

    public function getLastName() : ?string
    {
        return $this->_getField(self::FIELD_LAST_NAME, null);
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
        return $this->_getField(self::FIELD_NAME, null);
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
                self::FIELD_PARTIAL_DOB => $this->getPartialDateOfBirth()
            ]
        );

        return array_merge(
            $arrEntityData,
            parent::outputEntityData()
        );
    }
}
