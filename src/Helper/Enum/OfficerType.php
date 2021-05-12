<?php
namespace Kompli\Konnect\Helper\Enum;

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