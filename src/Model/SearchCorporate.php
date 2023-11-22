<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Iterator\CorporateHistoricNames as IttHistNames;
use Kompli\Konnect\Helper\Enum\CorporateStatus;
use Kompli\Konnect\Helper\Address;

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

    public function getAddressLineOne() : string
    {
        $arrAddressLines = explode(',', $this->getAddress());
        if (empty($arrAddressLines)) {
            return '';
        }

        $strLineOne = strtolower(trim($arrAddressLines[0]));
        if (
            $strLineOne === strtolower($this->getAddressCity()) ||
            $strLineOne === strtolower($this->getAddressPostcode())
        ) {
            return '';
        }
        return ucwords($strLineOne);
    }

    public function getAddressLineTwo() : string
    {
        $arrAddressLines = explode(',', $this->getAddress());
        if (empty($arrAddressLines) || !isset($arrAddressLines[1])) {
            return '';
        }

        $strLineTwo = strtolower(trim($arrAddressLines[1]));
        if (
            $strLineTwo === strtolower($this->getAddressCity()) ||
            $strLineTwo === strtolower($this->getAddressPostcode())
        ) {
            return '';
        }
        return ucwords($strLineTwo);
    }

    public function getAddressCity() : string
    {
        return Address::getCity($this->getAddress());
    }

    public function getAddressPostcode() : string
    {
        return Address::getPostcode($this->getAddress());
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

    public function bIsDissolved() : bool
    {
        $enumStatus = new CorporateStatus($this->getStatus());
        return $enumStatus->isTerminal();
    }

    /**
     * @codingStandardsIgnoreStart
     * @OA\Schema(
     *     schema="lib_konnect_search_corporate_item",
     *     type="object",
     *     @OA\Property(
     *         property="Type",
     *         type="string",
     *         description="Type of corporate search result"
     *     ),
     *     @OA\Property(
     *         property="Id",
     *         type="string",
     *         description="Id of search result"
     *     ),
     *     @OA\Property(
     *         property="Weight",
     *         type="string",
     *         description="Weight of search result"
     *     ),
     *     @OA\Property(
     *         property="Corporate",
     *         type="string",
     *         description="Name of associated company"
     *     ),

     *     @OA\Property(
     *         property="CRN",
     *         type="string",
     *         description="Company number of associated company"
     *     ),
     *     @OA\Property(
     *         property="Status",
     *         type="string",
     *         description="Current status of associated company"
     *     ),
     *     @OA\Property(
     *         property="IncorporationDate",
     *         type="string",
     *         description="Date of incorporation of associated company"
     *     ),
     *     @OA\Property(
     *         property="Address",
     *         type="string",
     *         description="Address of the associated company"
     *     ),
     *     @OA\Property(
     *         property="PreviousCompanyName",
     *         type="array",
     *         description="Previous known names for a company",
     *         @OA\Items(type="string")
     *     ),
     *     @OA\Property(
     *         property="HistoricNames",
     *         type="object",
     *         description="Historic names for a company",
     *             ref="#/components/schemas/lib_konnect_corporate_historic_name"
     *     )
     * )
     * @codingStandardsIgnoreEnd
     * @return array
     * @author Morgan Slater
     */
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