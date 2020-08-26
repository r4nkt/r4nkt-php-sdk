<?php

namespace R4nkt\PhpSdk\Resources;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class ApiResourceCollection implements ArrayAccess, Countable, IteratorAggregate
{
    /** @var array */
    public $resources;

    /** @var array */
    public $meta;

    /** @var \R4nkt\PhpSdk\R4nkt */
    protected $r4nkt;

    public function __construct(array $resources, ?array $meta = [], $r4nkt = null)
    {
        $this->resources = $resources;
        $this->meta = $meta;
        $this->r4nkt = $r4nkt;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->resources[] = $value;
        } else {
            $this->resources[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->resources[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->resources[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->resources[$offset]) ? $this->resources[$offset] : null;
    }

    public function count()
    {
        return count($this->resources);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->resources);
    }
}