<?php

namespace Kompli\Konnect\Iterator;

use Kompli\Konnect\Iterator\Model as IttModelAbstract;
use Kompli\Konnect\Model\Officer as ModelOfficer;

class Officers extends IttModelAbstract
{
    const MODEL_CLASS = ModelOfficer::class;

    public function getByName(string $strName) : ?ModelOfficer
    {
        foreach ($this as $modelOfficer) {
            $strModelName = preg_replace('/\s+/', ' ', $modelOfficer->getName());
            $strName = preg_replace('/\s+/', ' ', $strName);

            if (strtolower($strModelName) === strtolower($strName)) {
                return $modelOfficer;
            }

            $arrNames = explode(' ', $strName);
            $bFirstNameMatch = false;
            $bLastNameMatch = false;

            foreach ($arrNames as $strNamePart) {
                $arrFirstName = explode(' ', $modelOfficer->getFirstName());

                $strFirstName = $arrFirstName[0];

                if (
                    strtolower($strNamePart) ===
                    strtolower($strFirstName)
                ) {
                    $bFirstNameMatch = true;
                } else if (
                    strtolower($strNamePart) ===
                    strtolower($modelOfficer->getLastName())
                ) {
                    $bLastNameMatch = true;
                }
            }

            if ($bFirstNameMatch && $bLastNameMatch) {
                return $modelOfficer;
            }
        }

        return null;
    }
}