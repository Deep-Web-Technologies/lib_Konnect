<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Traits\Field\SetDirtyField;
use Exception;

abstract class ModelAbstract
{
    use SetDirtyField;
    private $_arrData;

    abstract public static function getFields();

    abstract public static function getPrimaryKey();

    protected function _getField(
        $strField,
        $mixedDefault = null,
        $arrContext = null
    )
    {
        return $this->_arrData[$strField] ?? $mixedDefault;
    }

    public function __construct(Array $arrData = [])
    {
        $this->_arrData = $arrData;
    }

    public function getId()
    {
        // I'd rather this be static than instance
        $id = static::getPrimaryKey();
        // If the ID is a multi-key then return an array of multiple keys
        if (is_array($id)) {
            return array_map(
                function($strKey) {
                    return $this->_getFieldOrFail($strKey);
                },
                $id
            );
        }
        return $this->_getFieldOrFail($id);
    }

    public function toArray()
    {
        return $this->_arrData;
    }
}