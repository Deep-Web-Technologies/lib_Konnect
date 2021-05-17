<?php
namespace Kompli\Konnect\Helper\Enum;
/**
 * @category
 * @package
 * @copyright 2019-02-06
 * @license
 * @author    Alex Jordan
 **/


class ResignedReason extends EnumAbstract
{
    const REASON_RESIGNED = 1;
    const REASON_DISSOLVED = 2;

    const VALUES = [
        self::REASON_RESIGNED,
        self::REASON_DISSOLVED,
    ];

    const REASON_DATA_MAP = [
        self::REASON_RESIGNED => 'Resigned',
        self::REASON_DISSOLVED => 'Dissolved',
    ];

    public function getResignedReason()
    {
        return self::REASON_DATA_MAP[$this->getId()];
    }
}