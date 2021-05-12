<?php
/**
 * @copyright 2019-01-10
 * @author Alan Good
**/

namespace Kompli\Konnect\Iterator;

use Kompli\Konnect\Exception\IllegalModelClass;
use Kompli\Konnect\Model\ModelAbstract;
use Exception;

/**
 * Iterator to go through a collection of elasticsearch result models
**/
abstract class Model implements IteratorInterface
{
    protected $_arrResults;
    private $_index = 0;
    const MODEL_CLASS = null;

    /**
     * Make the iterator with results array
    **/
    final public function __construct(array $arrResults)
    {
        $this->_arrResults = $arrResults;
    }

    //Implements Countable
    public function count()
    {
        return count($this->_arrResults);
    }

    /**
     * Return the current model
    **/
    public function current() : ModelAbstract
    {
        $strModelClass = static::MODEL_CLASS;
        if (empty($strModelClass)) {
            throw new Exception("$strModelClass not defined in ".static::class);
        }

        if (!class_exists($strModelClass)) {
            throw new IllegalModelClass($strModelClass);
        }
        return new $strModelClass($this->_arrResults[$this->_index]);
    }

    /**
     * Get the index
    **/
    public function key() : int
    {
        return $this->_index;
    }

    /**
     * Increment the index
    **/
    public function next() : void
    {
        $this->_index++;
    }

    /**
     * Rewind the index
    **/
    public function rewind() : void
    {
        $this->_index = 0;
    }

    public function setCurrent(ModelAbstract $model)
    {
        if (get_class($model) !== static::MODEL_CLASS) {
            throw new Exception(
                get_class($model) . ' does not match ' . static::MODEL_CLASS
            );
        }

        $this->_arrResults[$this->_index] = $model->toArray();
    }

    /**
     * Convert the iterator to an array e.g. for APIs
    **/
    public function toArray() : Array
    {
        return $this->_arrResults;
    }

    /**
     * Determine whether the current model is valid
    **/
    public function valid() : bool
    {
        return isset($this->_arrResults[$this->_index]);
    }

    public function filterWithCallback($callback) : self
    {
        $arr = [];
        foreach ($this->toArray() as $arrData) {
            $strModelClass = static::MODEL_CLASS;
            $model = new $strModelClass($arrData);
            if ($callback($model)) {
                $arr[] = $arrData;
            }
        }

        return new static($arr);
    }
}