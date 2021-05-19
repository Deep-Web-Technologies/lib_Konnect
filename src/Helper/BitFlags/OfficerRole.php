<?php

namespace Kompli\Konnect\Helper\BitFlags;
/**
 *
 * @codingStandardsIgnoreStart
 *
 * @OA\Schema(
 *     schema="konnect_officer_role",
 *     type="integer",
 *     description="An id that indicates the positions held by the officer within the company. The id is calculated by adding together a set value for each position held. For example if an officer is both a Director (id 1) and a secretary (id 2) it's officer role would be 3. The Id's used for each position are:
- director = 1
- secretary = 2
- llp member = 4
- llp designated member = 8
- judicial factor = 16
- receiver or manager = 32
- nominated director = 64
- member of administrative organ = 128
- member of supervisory organ = 256
- member of management organ = 512"
 * )
 * @codingStandardsIgnoreEnd
 *
 * @author Alex Jordan
 */

/**
 * This class and mirrors
 * prod_CommonCode/src/php/Common/Helper/BitFlags/OfficerRole
 * changes made here should also be made in CommonCode
 */
class OfficerRole extends BitFlagsAbstract
{
    const POS_DIRECTOR = 'director';
    const POS_SECRETARY = 'secretary';
    const POS_NON_DES_LLP_MEMBER = 'llp member';
    const POS_DES_LLP_MEMBER = 'llp designated member';
    const POS_JUDICIAL_FACTOR = 'judicial factor';
    const POS_RECEIVER_OR_MANAGER_APP_UNDER_CHARITIES_ACT
        = 'receiver or manager';
    const POS_MANAGER_APP_UNDER_CAICE_ACT = 'nominated director';
    const POS_SE_MEMBER_OF_ADMIN_ORGAN = 'member of administrative organ';
    const POS_SE_MEMBER_OF_SUPERVISORY_ORGAN = 'member of supervisory organ';
    const POS_SE_MEMBER_OF_MANAGEMENT_ORGAN = 'member of manegement organ';

    const TYPE_DIRECTOR  = 1;
    const TYPE_SECRETARY = 2;
    const TYPE_NON_DES_LLP_MEMBER = 4;
    const TYPE_DES_LLP_MEMBER = 8;
    const TYPE_JUDICIAL_FACTOR = 16;
    const TYPE_RECEIVER_OR_MANAGER_APP_UNDER_CHARITIES_ACT = 32;
    const TYPE_MANAGER_APP_UNDER_CAICE_ACT = 64;
    const TYPE_SE_MEMBER_OF_ADMIN_ORGAN = 128;
    const TYPE_SE_MEMBER_OF_SUPERVISORY_ORGAN = 256;
    const TYPE_SE_MEMBER_OF_MANAGEMENT_ORGAN = 512;

    const FLAGS = [
        self::POS_SECRETARY => self::TYPE_SECRETARY,
        self::POS_DIRECTOR => self::TYPE_DIRECTOR,
        self::POS_NON_DES_LLP_MEMBER => self::TYPE_NON_DES_LLP_MEMBER,
        self::POS_DES_LLP_MEMBER => self::TYPE_DES_LLP_MEMBER,
        self::POS_JUDICIAL_FACTOR => self::TYPE_JUDICIAL_FACTOR,
        self::POS_RECEIVER_OR_MANAGER_APP_UNDER_CHARITIES_ACT =>
            self::TYPE_RECEIVER_OR_MANAGER_APP_UNDER_CHARITIES_ACT,
        self::POS_MANAGER_APP_UNDER_CAICE_ACT =>
            self::TYPE_MANAGER_APP_UNDER_CAICE_ACT,
        self::POS_SE_MEMBER_OF_ADMIN_ORGAN =>
            self::TYPE_SE_MEMBER_OF_ADMIN_ORGAN,
        self::POS_SE_MEMBER_OF_SUPERVISORY_ORGAN =>
            self::TYPE_SE_MEMBER_OF_SUPERVISORY_ORGAN,
        self::POS_SE_MEMBER_OF_MANAGEMENT_ORGAN =>
            self::TYPE_SE_MEMBER_OF_MANAGEMENT_ORGAN,
    ];

    public static function createFromText(string $strRoleText) : self
    {
        $strFlagValue = self::FLAGS[$strRoleText] ?? 0;
        return new self($strFlagValue);
    }

    public function getRoleText() : string
    {
        $arrFlags = [];
        foreach (self::FLAGS as $strFlag => $intBit) {
            if ($this->_checkFlag($strFlag)) {
                $arrFlags[] = $strFlag;
            }
        }

        return implode(', ', $arrFlags);
    }
}