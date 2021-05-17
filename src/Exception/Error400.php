<?php

namespace Kompli\Konnect\Exception;
use Exception;

class Error400 extends Exception
{
    const MESSAGE   = 'Bad request (%s)';
    const HTTP_400  = 400;

    public function __construct($strError)
    {
        parent::__construct(sprintf(self::MESSAGE, $strError), self::HTTP_400);
    }
}
