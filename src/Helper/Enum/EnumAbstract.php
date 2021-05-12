<?php
/**
 * @category
 * @package
 * @copyright  2016-12-11
 * @license
 * @author     Kathie Dart
 **/
namespace Kompli\Konnect\Helper\Enum;

use Exception;

abstract class EnumAbstract
{
    const VALUES = [];

    private $_id;

    public static function getAllowedValues()
    {
        if (empty(static::VALUES)) {
            throw new Exception('Allowed values are empty');
        }

        return static::VALUES;
    }

    public function __construct($id)
    {
        if (!in_array($id, static::getAllowedValues())) {
            throw new Exception("Disallowed value: ($id)");
        }

        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }
}
