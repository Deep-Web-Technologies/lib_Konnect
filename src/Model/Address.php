<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\BitFlags\AddressSource;

class Address extends ModelAbstract
{
    const FIELD_ADDRESS_PK = 'AddressPK';
    const FIELD_ADDRESS_CLUSTER_ID = 'AddressClusterId';
    const FIELD_ADDRESS_IN_FULL = 'AddressInFull';
    const FIELD_POST_CODE = 'AddressPostalCode';
    const FIELD_COUNTRY = 'AddressCountry';
    const FIELD_LAT = 'AddressLat';
    const FIELD_LONG = 'AddressLong';
    const FIELD_TYPE = 'Type';
    const FIELD_LINKED_ENTITIES = 'LinkedEntities';
    const FIELD_CLUSTER_TYPE = 'ClusterType';
    const FIELD_OTHER_ADDRESSES = 'OtherAddresses';
    const FIELD_LINKED_CLUSTER_ENTITIES = 'LinkedClusterEntities';
    const FIELD_STREET_ADDRESS = 'AddressStreetAddress';
    const FIELD_LOCALITY = 'AddressLocality';
    const FIELD_REGION = 'AddressRegion';

    const PRIMARY_KEY = self::FIELD_ADDRESS_PK;

    const FIELDS = [
        self::FIELD_ADDRESS_PK,
        self::FIELD_ADDRESS_CLUSTER_ID,
        self::FIELD_ADDRESS_IN_FULL,
        self::FIELD_POST_CODE,
        self::FIELD_COUNTRY,
        self::FIELD_LAT,
        self::FIELD_LONG,
        self::FIELD_TYPE,
        self::FIELD_LINKED_ENTITIES,
        self::FIELD_CLUSTER_TYPE,
        self::FIELD_OTHER_ADDRESSES,
        self::FIELD_LINKED_CLUSTER_ENTITIES,
        self::FIELD_STREET_ADDRESS,
        self::FIELD_LOCALITY,
        self::FIELD_REGION,
    ];

    public static function getFields() : array
    {
        return self::FIELDS;
    }

    public static function getPrimaryKey()
    {
        return self::PRIMARY_KEY;
    }

    public function getAddressPK() : int
    {
        return $this->_getFieldOrFail(self::FIELD_ADDRESS_PK);
    }

    public function getAddressClusterId() : ?int
    {
        return $this->_getField(self::FIELD_ADDRESS_CLUSTER_ID, null);
    }

    public function getAddressInFull() : ?string
    {
        return $this->_getField(self::FIELD_ADDRESS_IN_FULL, null);
    }

    public function getAddressPostalCode() : ?string
    {
        return $this->_getField(self::FIELD_POST_CODE, null);
    }

    public function getAddressCountry() : ?string
    {
        return $this->_getField(self::FIELD_COUNTRY, null);
    }

    public function getAddressLat() : ?string
    {
        return $this->_getField(self::FIELD_LAT, null);
    }

    public function getAddressLong() : ?string
    {
        return $this->_getField(self::FIELD_LONG, null);
    }

    public function getStreetAddress() : ?string
    {
        return $this->_getField(self::FIELD_STREET_ADDRESS, null);
    }

    public function getLocality() : ?string
    {
        return $this->_getField(self::FIELD_LOCALITY, null);
    }

    public function getRegion() : ?string
    {
        return $this->_getField(self::FIELD_REGION, null);
    }

    public function getType() : ?AddressSource
    {
        $intAddressSource = $this->_getField(self::FIELD_TYPE, null);
        if (empty($intAddressSource)) {
            return null;
        }

        return new AddressSource($intAddressSource);
    }

    public function getLinkedEntities() : array
    {
        return $this->_getField(self::FIELD_LINKED_ENTITIES, []);
    }

    public function getClusterType() : ?AddressSource
    {
        $intClusterType = $this->_getField(self::FIELD_CLUSTER_TYPE, null);
        if (empty($intClusterType)) {
            return null;
        }

        return new AddressSource($intClusterType);
    }

    public function getOtherAddresses() : array
    {
        return $this->_getField(self::FIELD_OTHER_ADDRESSES, []);
    }

    public function getLinkedClusterEntities() : array
    {
        return $this->_getField(self::FIELD_LINKED_CLUSTER_ENTITIES, []);
    }

    public function outputLinked() : array
    {
        return [
            self::FIELD_ADDRESS_PK => $this->getAddressPK(),
            self::FIELD_ADDRESS_CLUSTER_ID => $this->getAddressClusterId(),
            self::FIELD_ADDRESS_IN_FULL => $this->getAddressInFull(),
            self::FIELD_POST_CODE => $this->getAddressPostalCode(),
            self::FIELD_COUNTRY => $this->getAddressCountry(),
            self::FIELD_LAT => $this->getAddressLat(),
            self::FIELD_LONG => $this->getAddressLong(),
            self::FIELD_TYPE => $this->getType()->getBitCollection(),
            self::FIELD_LINKED_ENTITIES => $this->getLinkedEntities(),
            self::FIELD_CLUSTER_TYPE =>
                $this->getClusterType()->getBitCollection(),
            self::FIELD_OTHER_ADDRESSES => $this->getOtherAddresses(),
            self::FIELD_LINKED_CLUSTER_ENTITIES =>
                $this->getLinkedClusterEntities(),
        ];
    }

    public function outputOfficer() : array
    {
        return [
            self::FIELD_POST_CODE => $this->getAddressPostalCode(),
            self::FIELD_COUNTRY => $this->getAddressCountry(),
            self::FIELD_LAT => $this->getAddressLat(),
            self::FIELD_LONG => $this->getAddressLong(),
            self::FIELD_STREET_ADDRESS => $this->getStreetAddress(),
            self::FIELD_LOCALITY => $this->getLocality(),
            self::FIELD_REGION => $this->getRegion()
        ];
    }
}