<?php

namespace Kompli\Konnect\Exception;
use Exception;
class IllegalModelClass extends Exception
{
    const MESSAGE   = 'Model Class Not Found (%s)';

    public function __construct($strClass = "")
    {
        parent::__construct(sprintf(self::MESSAGE, $strClass));
    }
}
