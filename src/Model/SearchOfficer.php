<?php

namespace Kompli\Konnect\Model;


use Kompli\Konnect\Helper\Enum\{
    OfficerType as EnumType,
    ResignedReason as EnumResignedReason
};
use Kompli\Konnect\Iterator\SearchOfficers as Itt;

class SearchOfficer extends ModelAbstract
{
    const FIELD_TYPE = 'Type';
    const FIELD_ID = 'Id';
    const FIELD_WEIGHT = 'Weight';
    const FIELD_NAME = 'Name';
    const FIELD_CORPORATE = 'Corporate';
    const FIELD_COMPANY_NUMBER = 'CompanyNumber';
    const FIELD_ADDRESS = 'Address';
    const FIELD_END_DATE = 'EndDate';
    const FIELD_IS_ACTIVE = 'IsActive';
    const FIELD_PREVIOUS_NAMES = 'PreviousNames';
    const FIELD_RESIGNED_REASON = 'ResignedReason';
    const FIELD_CLUSTER_ID = 'ClusterId';
    const FIELD_OFFICER_ID = 'OfficerId';
    const FIELD_OFFICER_TYPE = 'OfficerType';
    const FIELD_REST_OF_CLUSTER = 'RestOfCluster';

    const PRIMARY_KEY = self::FIELD_OFFICER_ID;

    const FIELDS = [
        self::FIELD_TYPE,
        self::FIELD_ID,
        self::FIELD_WEIGHT,
        self::FIELD_NAME,
        self::FIELD_CORPORATE,
        self::FIELD_COMPANY_NUMBER,
        self::FIELD_ADDRESS,
        self::FIELD_END_DATE,
        self::FIELD_IS_ACTIVE,
        self::FIELD_PREVIOUS_NAMES,
        self::FIELD_RESIGNED_REASON,
        self::FIELD_CLUSTER_ID,
        self::FIELD_OFFICER_ID,
        self::FIELD_OFFICER_TYPE,
        self::FIELD_REST_OF_CLUSTER,
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return self::PRIMARY_KEY;
    }

    public function getType() : ?string
    {
        return $this->_getField(self::FIELD_TYPE, null);
    }

    public function getId() : ?string
    {
        return $this->_getField(self::FIELD_ID, null);
    }

    public function getWeight() : ?string
    {
        return $this->_getField(self::FIELD_WEIGHT, null);
    }

    public function getName() : string
    {
        return $this->_getFieldOrFail(self::FIELD_NAME);
    }

    public function getCorporate() : string
    {
        return $this->_getFieldOrFail(self::FIELD_CORPORATE);
    }

    public function getCompanyNumber() : string
    {
        return $this->_getFieldOrFail(self::FIELD_COMPANY_NUMBER);
    }

    public function getAddress() : string
    {
        return $this->_getFieldOrFail(self::FIELD_ADDRESS);
    }

    public function getEndDate() : string
    {
        return $this->_getFieldOrFail(self::FIELD_END_DATE);
    }

    public function getIsActive() : string
    {
        return $this->_getFieldOrFail(self::FIELD_IS_ACTIVE);
    }

    public function getPreviousNames() : array
    {
        return $this->_getFieldOrFail(self::FIELD_PREVIOUS_NAMES);
    }

    public function getResignedReason() : string
    {
        return $this->_getFieldOrFail(self::FIELD_RESIGNED_REASON);
    }

    public function getClusterId() : int
    {
        return $this->_getFieldOrFail(self::FIELD_CLUSTER_ID);
    }

    public function getOfficerId() : int
    {
        return $this->_getFieldOrFail(self::FIELD_OFFICER_ID);
    }

    public function getOfficerType() : EnumType
    {
        return new EnumType($this->_getFieldOrFail(self::FIELD_OFFICER_TYPE));
    }

    public function getRestOfCluster() : Itt
    {
        return new Itt($this->_getField(self::FIELD_REST_OF_CLUSTER, []));
    }

    public function outputInCluster() : array
    {
        return [
            self::FIELD_NAME => $this->getName(),
            self::FIELD_CORPORATE => $this->getCorporate(),
            self::FIELD_COMPANY_NUMBER => $this->getCompanyNumber(),
            self::FIELD_ADDRESS => $this->getAddress(),
            self::FIELD_END_DATE => $this->getEndDate(),
            self::FIELD_IS_ACTIVE => $this->getIsActive(),
            self::FIELD_PREVIOUS_NAMES => $this->getPreviousNames(),
            self::FIELD_RESIGNED_REASON => $this->getResignedReason(),
            self::FIELD_CLUSTER_ID => $this->getClusterId(),
            self::FIELD_OFFICER_ID => $this->getOfficerId(),
            self::FIELD_OFFICER_TYPE => $this->getOfficerType()->getId(),
        ];
    }

    public function output() : array
    {
        $arrClusterModels = [];
        foreach ($this->getRestOfCluster() as $modelSearchData) {
            $arrClusterModels[] = $modelSearchData->outputInCluster();
        }

        return [
            self::FIELD_TYPE => $this->getType(),
            self::FIELD_ID => $this->getId(),
            self::FIELD_WEIGHT => $this->getWeight(),
            self::FIELD_NAME => $this->getName(),
            self::FIELD_CORPORATE => $this->getCorporate(),
            self::FIELD_COMPANY_NUMBER => $this->getCompanyNumber(),
            self::FIELD_ADDRESS => $this->getAddress(),
            self::FIELD_END_DATE => $this->getEndDate(),
            self::FIELD_IS_ACTIVE => $this->getIsActive(),
            self::FIELD_PREVIOUS_NAMES => $this->getPreviousNames(),
            self::FIELD_RESIGNED_REASON => $this->getResignedReason(),
            self::FIELD_CLUSTER_ID => $this->getClusterId(),
            self::FIELD_OFFICER_ID => $this->getOfficerId(),
            self::FIELD_OFFICER_TYPE => $this->getOfficerType()->getId(),
            self::FIELD_REST_OF_CLUSTER => $arrClusterModels,
        ];
    }
}