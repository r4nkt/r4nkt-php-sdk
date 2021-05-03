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

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->resources);
    }

    public function currentPage()
    {
        return $this->meta['current_page'];
    }

    public function from()
    {
        return $this->meta['from'];
    }

    public function lastPage()
    {
        return $this->meta['last_page'];
    }

    public function links()
    {
        return $this->meta['links'];
    }

    public function path()
    {
        return $this->meta['path'];
    }

    public function perPage()
    {
        return $this->meta['per_page'];
    }

    public function to()
    {
        return $this->meta['to'];
    }

    public function total()
    {
        return $this->meta['total'];
    }
}
