<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\Address;

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testGetFields()
    {
        $arrFields = [
            Address::FIELD_ADDRESS_PK,
            Address::FIELD_ADDRESS_CLUSTER_ID,
            Address::FIELD_ADDRESS_IN_FULL,
            Address::FIELD_POST_CODE,
            Address::FIELD_COUNTRY,
            Address::FIELD_LAT,
            Address::FIELD_LONG,
            Address::FIELD_TYPE,
            Address::FIELD_LINKED_ENTITIES,
            Address::FIELD_CLUSTER_TYPE,
            Address::FIELD_OTHER_ADDRESSES,
            Address::FIELD_LINKED_CLUSTER_ENTITIES,
            Address::FIELD_STREET_ADDRESS,
            Address::FIELD_LOCALITY,
            Address::FIELD_REGION,
        ];

        $this->assertEquals($arrFields, Address::getFields());
    }

    public function testGetters()
    {
        $arrData = [
            Address::FIELD_ADDRESS_PK => 1,
            Address::FIELD_ADDRESS_CLUSTER_ID => 2,
            Address::FIELD_ADDRESS_IN_FULL => 'address in full',
            Address::FIELD_POST_CODE => 'postcode',
            Address::FIELD_COUNTRY => 'country',
            Address::FIELD_LAT => 'latitude',
            Address::FIELD_LONG => 'longitude',
            Address::FIELD_TYPE => 3,
            Address::FIELD_LINKED_ENTITIES => ['linked entities'],
            Address::FIELD_CLUSTER_TYPE => 4,
            Address::FIELD_OTHER_ADDRESSES => ['other addresses'],
            Address::FIELD_LINKED_CLUSTER_ENTITIES => ['linked entity'],
            Address::FIELD_STREET_ADDRESS => 'street address',
            Address::FIELD_LOCALITY => 'locality',
            Address::FIELD_REGION => 'region',
        ];

        $model = new Address($arrData);

        $arrGetters = [
            Address::FIELD_ADDRESS_PK => $model->getAddressPK(),
            Address::FIELD_ADDRESS_CLUSTER_ID => $model->getAddressClusterId(),
            Address::FIELD_ADDRESS_IN_FULL => $model->getAddressInFull(),
            Address::FIELD_POST_CODE => $model->getAddressPostalCode(),
            Address::FIELD_COUNTRY => $model->getAddressCountry(),
            Address::FIELD_LAT => $model->getAddressLat(),
            Address::FIELD_LONG => $model->getAddressLong(),
            Address::FIELD_TYPE => $model->getType()->getBitCollection(),
            Address::FIELD_LINKED_ENTITIES => $model->getLinkedEntities(),
            Address::FIELD_CLUSTER_TYPE => $model->getClusterType()->getBitCollection(),
            Address::FIELD_OTHER_ADDRESSES => $model->getOtherAddresses(),
            Address::FIELD_LINKED_CLUSTER_ENTITIES => $model->getLinkedClusterEntities(),
            Address::FIELD_STREET_ADDRESS => $model->getStreetAddress(),
            Address::FIELD_LOCALITY => $model->getLocality(),
            Address::FIELD_REGION => $model->getRegion(),
        ];

        $this->assertEquals($arrData, $arrGetters);
    }

    public function testOutputLinked()
    {
        $arrData = [
            Address::FIELD_ADDRESS_PK => 1,
            Address::FIELD_ADDRESS_CLUSTER_ID => 2,
            Address::FIELD_ADDRESS_IN_FULL => 'address in full',
            Address::FIELD_POST_CODE => 'postcode',
            Address::FIELD_COUNTRY => 'country',
            Address::FIELD_LAT => 'latitude',
            Address::FIELD_LONG => 'longitude',
            Address::FIELD_TYPE => 3,
            Address::FIELD_LINKED_ENTITIES => ['linked entity'],
            Address::FIELD_CLUSTER_TYPE => 4,
            Address::FIELD_OTHER_ADDRESSES => ['other address'],
            Address::FIELD_LINKED_CLUSTER_ENTITIES => ['linked cluster entity']
        ];

        $model = new Address($arrData);

        $this->assertEquals($arrData, $model->outputLinked());
    }

    public function testOutputOfficer()
    {
        $arrData = [
            Address::FIELD_POST_CODE => 'post code',
            Address::FIELD_COUNTRY => 'country',
            Address::FIELD_LAT => 'latitude',
            Address::FIELD_LONG => 'longitude',
            Address::FIELD_STREET_ADDRESS => 'street address',
            Address::FIELD_LOCALITY => 'locality',
            Address::FIELD_REGION => 'region'
        ];

        $model = new Address($arrData);

        $this->assertEquals($arrData, $model->outputOfficer());
    }
}