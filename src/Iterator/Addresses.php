<?php

namespace Kompli\Konnect\Iterator;

use Kompli\Konnect\Iterator\Model as IttModelAbstract;
use Kompli\Konnect\Model\Address as ModelAddress;

class Addresses extends IttModelAbstract
{
    const MODEL_CLASS = ModelAddress::class;
}