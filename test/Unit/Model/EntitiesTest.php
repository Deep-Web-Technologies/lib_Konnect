<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\Entities;

use PHPUnit\Framework\TestCase;

class EntitiesTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            Entities::ENTITIES_OFFICERS,
            Entities::ENTITIES_CORPORATES,
            Entities::ENTITIES_PSCS,
        ];

        $this->assertEquals($arrFields, Entities::getFields());
    }

    public function testGetters()
    {
        $arrData = [
            Entities::ENTITIES_OFFICERS => ['officers'],
            Entities::ENTITIES_CORPORATES => ['corporates'],
            Entities::ENTITIES_PSCS => ['pscs']
        ];

        $modelEntities = new Entities($arrData);

        $arrGetters = [
            Entities::ENTITIES_OFFICERS => $modelEntities->getOfficers()->toArray(),
            Entities::ENTITIES_CORPORATES => $modelEntities->getCorporates()->toArray(),
            Entities::ENTITIES_PSCS => $modelEntities->getPSCs()->toArray(),
        ];

        $this->assertEquals($arrData, $arrGetters);
    }
}