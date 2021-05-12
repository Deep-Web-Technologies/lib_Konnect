<?php

namespace Kompli\Konnect\Helper\Enum;

use Kompli\Konnect\Helper\Enum\EnumAbstract;

class YotiDocumentType extends EnumAbstract
{
    const TYPE_PASSPORT        = 'PASSPORT';
    const TYPE_DRIVING_LICENCE = 'DRIVING_LICENCE';

    const VALUES = [
        self::TYPE_PASSPORT,
        self::TYPE_DRIVING_LICENCE
    ];
}