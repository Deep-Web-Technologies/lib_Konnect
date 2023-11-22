<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\ModelAbstract;

use Kompli\Konnect\Iterator\{
    Officers as IttOfficers,
    PSCs as IttPSCs,
    Corporates as IttCorporates
};

class Entities extends ModelAbstract
{
    const ENTITIES_OFFICERS   = 'Officers';
    const ENTITIES_CORPORATES = 'Corporates';
    const ENTITIES_PSCS       = 'PSCs';

    const FIELDS = [
        self::ENTITIES_OFFICERS,
        self::ENTITIES_CORPORATES,
        self::ENTITIES_PSCS,
    ];

    public static function getPrimaryKey()
    {

    }

    public static function getFields() : Array
    {
        return self::FIELDS;
    }

    public function getOfficers() : IttOfficers
    {
        return new IttOfficers(
            $this->_getField(self::ENTITIES_OFFICERS, [])
        );
    }

    public function getCorporates() : IttCorporates
    {
        return new IttCorporates(
            $this->_getField(self::ENTITIES_CORPORATES, [])
        );
    }

    public function getPSCs() : IttPSCs
    {
        return new IttPSCs(
            $this->_getField(self::ENTITIES_PSCS, [])
        );
    }

    public function setOfficers(IttOfficers $ittOfficers) : self
    {
        $this->_setField(self::ENTITIES_OFFICERS, $ittOfficers->toArray());

        return $this;
    }

    public function setCorporates(IttCorporates $ittCorporates) : self
    {
        $this->_setField(self::ENTITIES_CORPORATES, $ittCorporates->toArray());

        return $this;
    }

    public function setPSCs(IttPSCs $ittPSCs) : self
    {
        $this->_setField(self::ENTITIES_PSCS, $ittPSCs->toArray());

        return $this;
    }
}
