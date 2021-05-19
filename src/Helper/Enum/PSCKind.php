<?php
/**
 * @category
 * @package
 * @copyright  2019-02-28
 * @license
 * @author     Alex Jordan
 **/

namespace Kompli\Konnect\Helper\Enum;
use Exception;
/**
 *
 * @codingStandardsIgnoreStart
 *
 * @OA\Schema(
 *     schema="konnect_psc_kind",
 *     type="integer",
 *     description="The PSC kind indicates the type of entity the PSC represents. It has 6 possible values
- Individual person = 1
- Legal Entity (Government body, corporation, person) = 2
- Corporate entity = 3
- Statement concerning PSC = 4
- Super Secure Statement concerning PSC = 5
- Exemptions from declaring PSC = 6"
 * )
 * @codingStandardsIgnoreEnd
 *
 * @author Alex Jordan
 */

 /**
 * This class and mirrors
 * prod_CommonCode/src/php/Common/Helper/Enum/PSCKind
 * changes made here should also be made in CommonCode
 */
class PSCKind extends EnumAbstract
{
    const KEY_INDIVIDUAL_PSC
        = 'individual-person-with-significant-control';
    const KEY_LEGAL_PERSON_PSC
        = 'legal-person-person-with-significant-control';
    const KEY_CORPORATE_ENTITY_PSC
        = 'corporate-entity-person-with-significant-control';
    const KEY_PSC_STATEMENT
        = 'persons-with-significant-control-statement';
    const KEY_SUPER_SECURE_PSC
        = 'super-secure-person-with-significant-control';
    const KEY_EXEMPTIONS
        = 'exemptions';

    const ID_INDIVIDUAL_PSC = 1;
    const ID_LEGAL_PERSON_PSC = 2;
    const ID_CORPORATE_ENTITY_PSC = 3;
    const ID_PSC_STATEMENT = 4;
    const ID_SUPER_SECURE_PSC = 5;
    const ID_EXEMPTIONS = 6;

    const LABEL_INDIVIDUAL_PSC = 'Individual';
    const LABEL_LEGAL_PERSON_PSC = 'Legal Person';
    const LABEL_CORPORATE_ENTITY_PSC = 'Corporate';
    const LABEL_PSC_STATEMENT = 'Statement';
    const LABEL_SUPER_SECURE_PSC = 'Super Secure Statement';
    const LABEL_EXEMPTIONS = 'Exemptions';

    const VALUES = [
        self::KEY_INDIVIDUAL_PSC => self::ID_INDIVIDUAL_PSC,
        self::KEY_LEGAL_PERSON_PSC => self::ID_LEGAL_PERSON_PSC,
        self::KEY_CORPORATE_ENTITY_PSC => self::ID_CORPORATE_ENTITY_PSC,
        self::KEY_PSC_STATEMENT => self::ID_PSC_STATEMENT,
        self::KEY_SUPER_SECURE_PSC => self::ID_SUPER_SECURE_PSC,
        self::KEY_EXEMPTIONS => self::ID_EXEMPTIONS,
    ];

    const KEYS_BY_ID = [
        self::ID_INDIVIDUAL_PSC => self::KEY_INDIVIDUAL_PSC,
        self::ID_LEGAL_PERSON_PSC => self::KEY_LEGAL_PERSON_PSC,
        self::ID_CORPORATE_ENTITY_PSC => self::KEY_CORPORATE_ENTITY_PSC,
        self::ID_PSC_STATEMENT => self::KEY_PSC_STATEMENT,
        self::ID_SUPER_SECURE_PSC => self::KEY_SUPER_SECURE_PSC,
        self::ID_EXEMPTIONS => self::KEY_EXEMPTIONS,
    ];

    const LABEL_BY_ID = [
        self::ID_INDIVIDUAL_PSC => self::LABEL_INDIVIDUAL_PSC,
        self::ID_LEGAL_PERSON_PSC => self::LABEL_LEGAL_PERSON_PSC,
        self::ID_CORPORATE_ENTITY_PSC => self::LABEL_CORPORATE_ENTITY_PSC,
        self::ID_PSC_STATEMENT => self::LABEL_PSC_STATEMENT,
        self::ID_SUPER_SECURE_PSC => self::LABEL_SUPER_SECURE_PSC,
        self::ID_EXEMPTIONS => self::LABEL_EXEMPTIONS,
    ];

    /**
     * Allows the enum to be constructed by key
     *
     * @param string $strKey
     *
     * @throws Exception
     * @return self
     * @author Alex Jordan
     */
    public static function createByKey(string $strKey) : self
    {
        $intId = self::VALUES[$strKey] ?? null;
        if (is_null($intId)) {
            throw new Exception("Disallowed value: ($strKey)");
        }
        return new self($intId);
    }

    /**
     * Returns the human readable key of the value assigned to this enum
     *
     * @return string
     * @author Alex Jordan
     */
    public function getKey() : string
    {
        return self::KEYS_BY_ID[$this->getId()];
    }

    /**
     * Checks if a psc kind is a valid entity (person/company)
     *
     * @param integer $intKind
     * @return boolean
     */
    public function isEntity() : bool
    {
        $intKind = $this->getId();
        if (
            $intKind == self::ID_INDIVIDUAL_PSC ||
            $intKind == self::ID_CORPORATE_ENTITY_PSC ||
            $intKind == self::ID_LEGAL_PERSON_PSC
        ) {
            return true;
        }

        return false;
    }

    public function isStatement() : bool
    {
        if (self::ID_PSC_STATEMENT === $this->getId()) {
            return true;
        }
        return false;
    }

    public function isSuperSecure() : bool
    {
        if (self::ID_SUPER_SECURE_PSC === $this->getId()) {
            return true;
        }
        return false;
    }

    public function isExemption() : bool
    {
        if (self::ID_EXEMPTIONS === $this->getId()) {
            return true;
        }
        return false;
    }

    public function isIndividual() : bool
    {
        if (self::ID_INDIVIDUAL_PSC === $this->getId()) {
            return true;
        }
        return false;
    }

    public function getLabel() : string
    {
        return self::LABEL_BY_ID[$this->getId()];
    }
}
