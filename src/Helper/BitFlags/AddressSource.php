<?php
/**
 * Bitflag representing the flag type on an entity within the konnect_main
 * database
 *
 * @copyright  2019-02-04
 * @author     Alex Jordan
 **/

namespace Kompli\Konnect\Helper\BitFlags;

class AddressSource extends BitFlagsAbstract
{
    const SOURCE_OFFICER = "officer";
    const SOURCE_CORPORATE = "corporate";
    const SOURCE_PSC = "psc";

    const OUTPUT_SOURCE_OFFICER = "Officer";
    const OUTPUT_SOURCE_CORPORATE = "Corporate";
    const OUTPUT_SOURCE_PSC = "PSC";

    const FLAGS = [
        self::SOURCE_OFFICER => 1,
        self::SOURCE_CORPORATE => 2,
        self::SOURCE_PSC => 4,
    ];

    const OUTPUT = [
        self::SOURCE_OFFICER => self::OUTPUT_SOURCE_OFFICER,
        self::SOURCE_CORPORATE => self::OUTPUT_SOURCE_CORPORATE,
        self::SOURCE_PSC => self::OUTPUT_SOURCE_PSC,
    ];

    /**
     * Gets an array of the flags present in the bitmask
     *
     * @return array
     * @author Alex Jordan
    **/
    public function getFlags() : array
    {
        $arrFlags = [];
        foreach (self::FLAGS as $strFlag => $intBitValue) {
            if ($this->_checkFlag($strFlag)) {
                $arrFlags[] = self::OUTPUT[$strFlag];
            }
        }
        return $arrFlags;
    }

    public function isCorporate() : bool
    {
        return $this->_checkFlag(self::SOURCE_CORPORATE);
    }
}