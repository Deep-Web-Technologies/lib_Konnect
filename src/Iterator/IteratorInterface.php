<?php

namespace Kompli\Konnect\Iterator;

/**
 * @copyright 2019-01-10
 * @author Alan Good
**/
interface IteratorInterface extends \Iterator, \Countable
{
    public function toArray() : Array;
}