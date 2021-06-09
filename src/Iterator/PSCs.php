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
            $strModelName = preg_replace('/\s+/', ' ', $modelPSC->getName());
            $strName = preg_replace('/\s+/', ' ', $strName);

            if (strtolower($strModelName) === strtolower($strName)) {
                return $modelPSC;
            }

            $arrNames = explode(' ', $strName);
            $bFirstNameMatch = false;
            $bLastNameMatch = false;

            foreach ($arrNames as $strNamePart) {
                $arrFirstName = explode(' ', $modelPSC->getFirstName());

                $strFirstName = $arrFirstName[0];

                if (
                    strtolower($strNamePart) ===
                    strtolower($strFirstName)
                ) {
                    $bFirstNameMatch = true;
                } else if (
                    strtolower($strNamePart) ===
                    strtolower($modelPSC->getLastName())
                ) {
                    $bLastNameMatch = true;
                }
            }

            if ($bFirstNameMatch && $bLastNameMatch) {
                return $modelPSC;
            }
        }

        return null;
    }
}