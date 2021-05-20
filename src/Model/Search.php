<?php

namespace Kompli\Konnect\Model;

use Exception;
use Kompli\Konnect\Helper\Enum\{
    OfficerType as EnumType,
    ResignedReason as EnumResignedReason
};
use Kompli\Konnect\Iterator\{
    SearchOfficers as IttSearchOfficers,
    SearchCorporates as IttSearchCorporates,
    Model as IttModelAbstract
};

class Search extends ModelAbstract
{
    const FIELD_COUNT = 'Count';
    const FIELD_TOTAL = 'TotalCount';
    const FIELD_DATA  = 'Data';

    const TYPE_OFFICER = 'officer';
    const TYPE_CORPORATE = 'corporate';

    const FIELDS = [
        self::FIELD_COUNT,
        self::FIELD_TOTAL,
        self::FIELD_DATA,
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return null;
    }

    public function getCount() : int
    {
        return $this->_getFieldOrFail(self::FIELD_COUNT);
    }

    public function getTotalCount() : int
    {
        return $this->_getFieldOrFail(self::FIELD_TOTAL);
    }

    public function getData($strType) : IttModelAbstract
    {
        $arrData = $this->_getField(self::FIELD_DATA, []);
        switch ($strType) {
            case self::TYPE_CORPORATE:
                return new IttSearchCorporates($arrData);
            case self::TYPE_OFFICER:
                return new IttSearchOfficers($arrData);
            default:
                throw new \Exception('Invalid search iterator a type');
        }
    }

    public function output($strType) : array
    {
        $itt = $this->getData($strType);

        $arrData = [];
        foreach ($itt as $modelSearch) {
            $arrData[] = $itt->output();
        }

        return [
            self::FIELD_COUNT => $this->getCount(),
            self::FIELD_TOTAL => $this->getTotalCount(),
            self::FIELD_DATA  => $arrData,
        ];
    }
}