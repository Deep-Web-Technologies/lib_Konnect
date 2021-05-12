<?php

namespace Kompli\Konnect\Helper\Enum;

use Kompli\Konnect\Helper\Enum\EnumAbstract;

class QEDProductSendType extends EnumAbstract
{
    const TYPE_EMAIL  = 1;
    const TYPE_LINK   = 2;
    const TYPE_SMS    = 3;
    const TYPE_UPLOAD = 4;

    const VALUES = [
        self::TYPE_EMAIL,
        self::TYPE_LINK,
        self::TYPE_SMS,
        self::TYPE_UPLOAD
    ];
}