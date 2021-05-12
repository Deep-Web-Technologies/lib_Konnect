<?php
namespace Kompli\Konnect\Helper\BitFlags;

use Exception;

/**
 * Abstract class to handle the use of bit flags
 *
 * @copyright  2018-05-21
 * @author     Alex Jordan
 **/
abstract class BitFlagsAbstract
{
    const FLAGS = [];

    protected $_bitCollection;

    /**
     * Static function to create a bit flag help object from an array of flags
     *
     * @param array $arrFlags
     * @return self
     * @throws Exception    Thrown if one of the given flags isn't valid
     * @author Alex Jordan
     */
    public static function create(array $arrFlags) : self
    {
        $intFlagTotal = 0;
        foreach ($arrFlags as $strFlag) {
            if (!isset(static::FLAGS[$strFlag])) {
                throw new Exception("Flag $strFlag is not valid");
            }
            // Use bitwise OR to 'merge in' values (so the same flag doesn't
            // contribute to the total more than once)
            $intFlagTotal = $intFlagTotal | static::FLAGS[$strFlag];
        }

        return new static($intFlagTotal);
    }

    /**
     * Returns the max value allowed for a bit collection
     *
     * @return int
     * @author Alex Jordan
     */
    protected static function getMaxCollection() : int
    {
        if (empty(static::FLAGS)) {
            throw new Exception('Allowed flags are empty');
        }

        return array_sum(static::FLAGS);
    }

    /**
     * @param integer $bitCollection    The collection of bit flags to check
     *                                  against
     * @author Alex Jordan
     */
    final public function __construct(int $bitCollection)
    {
        $intMaxValue = static::getMaxCollection();
        if ($intMaxValue < $bitCollection) {
            throw new Exception(
                "The bit collection ($bitCollection) is greater than the ".
                "maximum value ($intMaxValue)."
            );
        }
        if (0 > $bitCollection) {
            throw new Exception(
                "The bit collection ($bitCollection) is negative"
            );
        }

        $this->_bitCollection = $bitCollection;
    }

    /**
     * Function to check if the bit flag is represented in the bit collection
     *
     * @param string $strFlag   The name of the flag to check
     * @return boolean
     * @author Alex Jordan
     */
    protected function _checkFlag(string $strFlag) : bool
    {
        if (!isset(static::FLAGS[$strFlag])) {
            throw new Exception("The flag ($strFlag) doesn't exist");
        }
        return (bool)($this->_bitCollection & static::FLAGS[$strFlag]);
    }

    /**
     * Returns the bit collection of the bit flag field
     *
     * @return integer
     * @author Alex Jordan
     */
    public function getBitCollection() : int
    {
        return $this->_bitCollection;
    }

    public static function getIdFromLabel(string $strFlag) : int
    {
        if (!isset(static::FLAGS[$strFlag])) {
            throw new Exception("Flag $strFlag is not valid");
        }
        return static::FLAGS[$strFlag];
    }

    public function add(string $strFlag) : self
    {
        if (!isset(static::FLAGS[$strFlag])) {
            throw new Exception("Flag $strFlag is not valid");
        }
        $this->_bitCollection |= static::FLAGS[$strFlag];
        return $this;
    }

    public function merge(self $bitFlag)
    {
        $this->_bitCollection |= $bitFlag->getBitCollection();
    }
}
