<?php
namespace Kompli\Konnect\Model;

class CorporateHistoricName extends ModelAbstract
{
    const FIELD_COMPANY_NAME     = 'CompanyName';
    const FIELD_DATE_FROM        = 'DateFrom';
    const FIELD_DATE_TO          = 'DateTo';

    const PRIMARY_KEY = self::FIELD_COMPANY_NAME;

    const FIELDS = [
        self::FIELD_COMPANY_NAME,
        self::FIELD_DATE_FROM,
        self::FIELD_DATE_TO,
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return self::PRIMARY_KEY;
    }

    public function getCompanyName() : string
    {
        return $this->_getFieldOrFail(self::FIELD_COMPANY_NAME);
    }

    public function getDateFrom() : string
    {
        return $this->_getFieldOrFail(self::FIELD_DATE_FROM);
    }

    public function getDateTo() : string
    {
        return $this->_getFieldOrFail(self::FIELD_DATE_TO);
    }


    /**
     * @codingStandardsIgnoreStart
     * @OA\Schema(
     *     schema="lib_konnect_corporate_historic_name",
     *     type="object",
     *     @OA\Property(
     *         property="CompanyName",
     *         type="string",
     *         description="Historic name of company"
     *     ),
     *     @OA\Property(
     *         property="DateFrom",
     *         type="string",
     *         description="Historic name date from"
     *     ),
     *     @OA\Property(
     *         property="DateTo",
     *         type="string",
     *         description="Historic name date to"
     *     )
     * )
     * @codingStandardsIgnoreEnd
     * @return array
     * @author Morgan Slater
     */
    public function output(): array
    {
        return [
            self::FIELD_COMPANY_NAME => $this->getCompanyName(),
            self::FIELD_DATE_FROM    => $this->getDateFrom(),
            self::FIELD_DATE_TO      => $this->getDateTo()
        ];
    }
}