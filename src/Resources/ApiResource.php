<?php

namespace R4nkt\PhpSdk\Resources;

use ReflectionObject;
use ReflectionProperty;

class ApiResource
{
    /** @var array */
    public $attributes = [];

    /** @var \R4nkt\PhpSdk\R4nkt */
    protected $r4nkt;

    /**
     * @param  array $attributes
     * @param  \R4nkt\PhpSdk\R4nkt $r4nkt
     */
    public function __construct(array $attributes, $r4nkt = null)
    {
        $this->attributes = $attributes;

        $this->r4nkt = $r4nkt;

        $this->fill();
    }

    protected function fill()
    {
        foreach ($this->attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

    protected function camelCase(string $key): string
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

    public function __sleep()
    {
        $publicProperties = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        $publicPropertyNames = array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, $publicProperties);

        return array_diff($publicPropertyNames, ['r4nkt', 'attributes']);
    }
}
