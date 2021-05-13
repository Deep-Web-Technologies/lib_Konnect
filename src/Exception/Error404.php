<?php

namespace Kompli\Konnect\Exception;
use Exception;

class Error404 extends Exception
{
    const MESSAGE   = 'Not Found (%s)';
    const HTTP_404  = 404;

    public function __construct($strError = "")
    {
        parent::__construct(sprintf(self::MESSAGE, $strError), self::HTTP_404);
    }
}
