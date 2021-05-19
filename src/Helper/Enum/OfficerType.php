<?php
namespace Kompli\Konnect\Helper\Enum;

/**
 * This class and mirrors
 * prod_CommonCode/src/php/Common/Helper/Enum/OfficerType
 * changes made here should also be made in CommonCode
 */
class OfficerType extends EnumAbstract
{
    const TYPE_PERSON = 'Person';
    const TYPE_COMPANY = 'Company';

    const VALUES = [
        self::TYPE_PERSON,
        self::TYPE_COMPANY,
    ];

    public function isPerson() : bool
    {
        return (self::TYPE_PERSON === $this->getId());
    }

    public function isCompany() : bool
    {
        return (self::TYPE_COMPANY === $this->getId());
    }
}