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


    /**
     * @codingStandardsIgnoreStart
     * @OA\Schema(
     *     schema="lib_konnect_search_officer",
     *     type="object",
     *     @OA\Property(
     *         property="Count",
     *         type="integer",
     *         description="Count of results displayed"
     *     ),
     *     @OA\Property(
     *         property="TotalCount",
     *         type="integer",
     *         description="Count of total results"
     *     ),
     *     @OA\Property(
     *         property="Data",
     *         type="array",
     *         @OA\Items(
     *             ref="#/components/schemas/lib_konnect_search_officer_item"
     *         )
     *     )
     * )
     * @codingStandardsIgnoreEnd
     * @return array
     * @author Morgan Slater
     */

    /**
     * @codingStandardsIgnoreStart
     * @OA\Schema(
     *     schema="lib_konnect_search_corporate",
     *     type="object",
     *     @OA\Property(
     *         property="Count",
     *         type="integer",
     *         description="Count of results displayed"
     *     ),
     *     @OA\Property(
     *         property="TotalCount",
     *         type="integer",
     *         description="Count of total results"
     *     ),
     *     @OA\Property(
     *         property="Data",
     *         type="array",
     *         @OA\Items(
     *             ref="#/components/schemas/lib_konnect_search_corporate_item"
     *         )
     *     )
     * )
     * @codingStandardsIgnoreEnd
     * @return array
     * @author Morgan Slater
     */
    public function output($strType) : array
    {
        $itt = $this->getData($strType);

        $arrData = [];
        foreach ($itt as $modelSearch) {
            $arrData[] = $modelSearch->output();
        }

        return [
            self::FIELD_COUNT => $this->getCount(),
            self::FIELD_TOTAL => $this->getTotalCount(),
            self::FIELD_DATA  => $arrData,
        ];
    }
}