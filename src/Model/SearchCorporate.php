<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Iterator\CorporateHistoricNames as IttHistNames;

class SearchCorporate extends ModelAbstract
{
    const FIELD_TYPE                = 'Type';
    const FIELD_ID                  = 'Id';
    const FIELD_WEIGHT              = 'Weight';
    const FIELD_CORPORATE           = 'Corporate';
    const FIELD_CRN                 = 'CRN';
    const FIELD_STATUS              = 'Status';
    const FIELD_INCORPORATION_DATE  = 'IncorporationDate';
    const FIELD_ADDRESS             = 'Address';
    const FIELD_PREVIOUS_NAMES      = 'PreviousCompanyName';
    const FIELD_HISTORIC_NAMES      = 'HistoricNames';

    const PRIMARY_KEY = self::FIELD_ID;
    const FIELDS = [
        self::FIELD_TYPE,
        self::FIELD_ID,
        self::FIELD_WEIGHT,
        self::FIELD_CORPORATE,
        self::FIELD_CRN,
        self::FIELD_STATUS,
        self::FIELD_INCORPORATION_DATE,
        self::FIELD_ADDRESS,
        self::FIELD_PREVIOUS_NAMES,
        self::FIELD_HISTORIC_NAMES,
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return self::PRIMARY_KEY;
    }

    public function getType() : string
    {
        return $this->_getFieldOrFail(self::FIELD_TYPE);
    }

    public function getId() : string
    {
        return $this->_getFieldOrFail(self::FIELD_ID);
    }

    public function getWeight() : string
    {
        return $this->_getFieldOrFail(self::FIELD_WEIGHT);
    }

    public function getCorporate() : string
    {
        return $this->_getFieldOrFail(self::FIELD_CORPORATE);
    }

    public function getCRN() : string
    {
        return $this->_getFieldOrFail(self::FIELD_CRN);
    }

    public function getStatus() : string
    {
        return $this->_getFieldOrFail(self::FIELD_STATUS);
    }

    public function getIncorporationDate() : string
    {
        return $this->_getField(self::FIELD_INCORPORATION_DATE, "");
    }

    public function getAddress() : string
    {
        return $this->_getField(self::FIELD_ADDRESS, "");
    }

    public function getPreviousNames() : array
    {
        return $this->_getField(self::FIELD_PREVIOUS_NAMES, []);
    }

    public function getHistoricNames() : IttHistNames
    {
        $ittHistNames = new IttHistNames(
            $this->_getField(self::FIELD_HISTORIC_NAMES, [])
        );

        return $ittHistNames;
    }

    public function output() : array
    {
        $ittHistNames = $this->getHistoricNames();

        $arrHistNames = [];
        foreach ($ittHistNames as $modelHistName) {
            $arrHistNames[] = $modelHistName->output();
        }

        return [
            self::FIELD_TYPE => $this->getType(),
            self::FIELD_ID => $this->getId(),
            self::FIELD_WEIGHT => $this->getWeight(),
            self::FIELD_CORPORATE => $this->getCorporate(),
            self::FIELD_CRN => $this->getCRN(),
            self::FIELD_STATUS => $this->getStatus(),
            self::FIELD_INCORPORATION_DATE => $this->getIncorporationDate(),
            self::FIELD_ADDRESS => $this->getAddress(),
            self::FIELD_PREVIOUS_NAMES => $this->getPreviousNames(),
            self::FIELD_HISTORIC_NAMES => $arrHistNames,
        ];
    }
}