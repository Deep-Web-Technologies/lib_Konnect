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

    const OUTPUT_RESIGNED = 'Resigned';
    const OUTPUT_DISSOLVED = 'Dissolved';

    const VALUES = [
        self::OUTPUT_RESIGNED => self::REASON_RESIGNED,
        self::OUTPUT_DISSOLVED => self::REASON_DISSOLVED,
    ];

    const REASON_DATA_MAP = [
        self::REASON_RESIGNED => 'Resigned',
        self::REASON_DISSOLVED => 'Dissolved',
    ];

    public static function createFromOutput(string $strOutput)
    {
        $intId = self::VALUES[$strOutput] ?? null;

        if (is_null($intId)) {
            throw new \Exception("Disallowed value: ($strOutput)");
        }

        return new self($intId);
    }

    public function getResignedReason()
    {
        return self::REASON_DATA_MAP[$this->getId()];
    }
}