<?php
declare(strict_types=1);
namespace Kompli\Konnect\Traits\Field;

trait SetDirtyField
{
    use GetField;

    // Holds changed data
    private $_arrDirty = [];

    private $_arrInc = [];

    /**
     * Use to set data
     *
     * @param $strField string field name
     * @param $mixedValue mixed value
     * @return $this (fluent)
     * @author Kathie Dart
     *
    **/
    protected function _setField(string $strField, $mixedValue) : self
    {
        $mixOldValue = $this->_arrData[$strField] ?? null;
        // If the field doesn't change then no need to change dirty
        if ($mixedValue === $mixOldValue) {
            return $this;
        }
        $this->_arrData[$strField] = $mixedValue;
        $this->_arrDirty[$strField] = $mixedValue;
        return $this;
    }

    /**
     * Increments a field element
     *
     * @param $strField string field to get
     * @param $intAmount int amount to increment
     * @return $this
     * @author Kathie Dart
    **/
    protected function _incField(
        string $strField,
        int $intAmount = 1
    ) : self
    {
        $this->_arrData[$strField] = ($this->_arrData[$strField] ?? 0) +
            $intAmount;
        $this->_arrInc[$strField] = ($this->_arrInc[$strField] ?? 0) +
            $intAmount;
        return $this;
    }

    /**
     * Returns whether this is a dirty model
     *
     * @return bool
     * @author Kathie Dart
    **/
    public function isDirty() : bool
    {
        return !empty($this->_arrDirty) ||
            !empty($this->_arrInc);
    }

    /**
     * Sets the model as no longer dirty
     * TODO: Maybe require a dao
     *
     * @return $this
     * @author Kathie Dart
    **/
    public function setClean() : self
    {
        $this->_arrDirty = [];
        $this->_arrInc = [];

        return $this;
    }
}
