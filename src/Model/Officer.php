<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\BitFlags\OfficerRole;
use Kompli\Konnect\Helper\Enum\OfficerType;
use Exception;

class Officer extends KonnectAbstract
{
    const FIELD_ID           = 'Id';
    const FIELD_NAME         = 'Name';
    const FIELD_FIRST_NAME   = 'FirstName';
    const FIELD_LAST_NAME    = 'LastName';
    const FIELD_OFFICER_ROLE = 'OfficerRole';
    const FIELD_POSITION     = 'Position';
    const FIELD_START_DATE   = 'StartDate';
    const FIELD_END_DATE     = 'EndDate';
    const FIELD_NATIONALITY  = 'Nationality';
    const FIELD_PARTIAL_DOB  = 'PartialDateOfBirth';
    const FIELD_ADDRESS_PK   = 'AddressPK';
    const FIELD_TYPE         = 'Type';
    const FIELD_OCR_ID       = 'OfficerClusterRootId';
    const FIELD_ADDRESS      = 'AddressInFull';
    const FIELD_PREVIOUS_NAMES = 'PreviousNames';

    const PRIMARY_KEY        = self::FIELD_ID;

    const FIELDS = [
        self::FIELD_ID,
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
        self::FIELD_ADDRESS,
        self::FIELD_PREVIOUS_NAMES
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

    public function getName() : ?string
    {
        return $this->_getField(self::FIELD_NAME, null);
    }

    public function getFirstName() : ?string
    {
        return $this->_getField(self::FIELD_FIRST_NAME, null);
    }

    public function getLastName() : ?string
    {
        return $this->_getField(self::FIELD_LAST_NAME, null);
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
        return $this->_getField(self::FIELD_ADDRESS, null);
    }

    public function getPreviousNames() : array
    {
        return $this->_getField(self::FIELD_PREVIOUS_NAMES, []);
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
            self::FIELD_ID           => $this->getId(),
            self::FIELD_NAME         => $this->getName(),
            self::FIELD_FIRST_NAME   => $this->getFirstName(),
            self::FIELD_LAST_NAME    => $this->getLastName(),
            self::FIELD_OFFICER_ROLE => $intRole,
            self::FIELD_POSITION     => $this->getPosition(),
            self::FIELD_START_DATE   => $this->getStartDate(),
            self::FIELD_END_DATE     => $this->getEndDate(),
            self::FIELD_NATIONALITY  => $this->getNationality(),
            self::FIELD_PARTIAL_DOB  => $this->getPartialDateOfBirth(),
            self::FIELD_ADDRESS_PK   => $this->getAddressPK(),
            self::FIELD_TYPE         => $strType,
            self::FIELD_OCR_ID       => $this->getOfficerClusterRootId(),
            self::FIELD_ADDRESS      => $this->getAddressInFull()
        ];
    }

    public function outputEntityData() : array
    {
        $arrEntityData = array_filter(
            [
                self::FIELD_ADDRESS => $this->getAddressInFull(),
                self::FIELD_PARTIAL_DOB => $this->getPartialDateOfBirth(),
                self::FIELD_PREVIOUS_NAMES => $this->getPreviousNames()
            ]
        );

        return array_merge(
            $arrEntityData,
            parent::outputEntityData()
        );
    }
}