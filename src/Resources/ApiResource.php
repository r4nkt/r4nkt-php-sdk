<?php

namespace R4nkt\PhpSdk\Resources;

use R4nkt\PhpSdk\R4nkt;
use ReflectionObject;
use ReflectionProperty;

class ApiResource
{
    public array $attributes = [];

    protected R4nkt $r4nkt;

    public function __construct(array $attributes, R4nkt $r4nkt = null)
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

    public function __sleep()
    {
        $publicProperties = (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        $publicPropertyNames = array_map(function (ReflectionProperty $property) {
            return $property->getName();
        }, $publicProperties);

        return array_diff($publicPropertyNames, ['r4nkt', 'attributes']);
    }
}
