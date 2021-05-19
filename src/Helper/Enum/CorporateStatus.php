<?php
namespace Kompli\Konnect\Helper\Enum;

/**
 * This class and mirrors
 * prod_CommonCode/src/php/Common/Helper/Enum/CorporateStatus
 * changes made here should also be made in CommonCode
 */
class CorporateStatus extends EnumAbstract
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_VOLUNTARY_ARRANGEMENT = 'Voluntary Arrangement';
    const STATUS_CONVERTED_CLOSED = 'Converted/Closed';
    const STATUS_DISSOLVED = 'Dissolved';
    const STATUS_DISSOLVING = 'Dissolving';
    const STATUS_DELETED = 'Deleted';
    const STATUS_LIQUIDATION = 'Liquidation';
    const STATUS_RECEIVERSHIP = 'Receivership';
    const STATUS_WINDING_UP = 'WindingUp';

    const VALUES = [
        self::STATUS_ACTIVE,
        self::STATUS_VOLUNTARY_ARRANGEMENT,
        self::STATUS_CONVERTED_CLOSED,
        self::STATUS_DISSOLVED,
        self::STATUS_DISSOLVING,
        self::STATUS_DELETED,
        self::STATUS_LIQUIDATION,
        self::STATUS_RECEIVERSHIP,
        self::STATUS_WINDING_UP,
    ];

    const TERMINAL_STATUSES = [
        self::STATUS_DISSOLVED => true,
        self::STATUS_CONVERTED_CLOSED => true,
        self::STATUS_DELETED => true,
    ];

    const INSOLVENT_STATUSES = [
        self::STATUS_LIQUIDATION => true,
        self::STATUS_RECEIVERSHIP => true,
        self::STATUS_WINDING_UP => true,
    ];

    /**
     * Indicates if the status means the corporate is not currently operating
     *
     * @return boolean
     * @author Alex Jordan
     */
    public function isTerminal() : bool
    {
        return self::TERMINAL_STATUSES[$this->getId()] ?? false;
    }

    public function isInsolvent() : bool
    {
        return self::INSOLVENT_STATUSES[$this->getId()] ?? false;
    }
}