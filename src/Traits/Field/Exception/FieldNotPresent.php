<?php
namespace Kompli\Konnect\Traits\Field\Exception;

class FieldNotPresent extends \Exception
{
    const MESSAGE = 'The field (%s) is not present in %s - the data is %s';

    public function __construct($strField, $strClass, $strData)
    {
        parent::__construct(
            sprintf(
                self::MESSAGE,
                $strField,
                $strClass,
                $strData
            )
        );
    }
}
