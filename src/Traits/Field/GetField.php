<?php
declare(strict_types=1);
namespace Kompli\Konnect\Traits\Field;

use Kompli\Konnect\Traits\Field\Exception\FieldNotPresent;

trait GetField
{
    /**
     * Gets the field requested (and if the field is not
     *      set then this returns the default value)
     *
     * @param string $strField
     * @param mixed $mixedDefault
     *
     * @return mixed
     *
     * @author Tim Langley
     **/
    protected function _getField($strField, $mixedDefault, $arrContext = null)
    {
        return $this->_arrData[$strField] ?? $mixedDefault;
    }
    /**
     * Gets the field requested (and if the field is not
     *      set then this throws an exception)
     *
     * @param string $strField
     *
     * @return mixed
     *
     * @author Kathie Dart
     **/
    protected function _getFieldOrFail($strField, $arrContext = null)
    {
        // If context isn't defined by user use all the stored data
        if (is_null($arrContext)) {
            $arrContext = $this->_arrData;
        }
        if (!array_key_exists($strField, $arrContext)) {
            throw new FieldNotPresent(
                $strField,
                get_class($this),
                json_encode($arrContext)
            );
        }

        return $arrContext[$strField];
    }
}
