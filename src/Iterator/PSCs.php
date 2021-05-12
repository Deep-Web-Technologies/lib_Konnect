<?php

namespace Kompli\Konnect\Iterator;

use Kompli\Konnect\Iterator\Model as IttModelAbstract;
use Kompli\Konnect\Model\PSC as ModelPSC;

class PSCs extends IttModelAbstract
{
    const MODEL_CLASS = ModelPSC::class;

    public function getByName(string $strName) : ?ModelPSC
    {
        foreach ($this as $modelPSC) {
            if (strtolower($modelPSC->getName()) === strtolower($strName)) {
                return $modelPSC;
            }
        }

        return null;
    }
}