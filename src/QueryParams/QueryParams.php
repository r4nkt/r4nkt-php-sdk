<?php

namespace R4nkt\PhpSdk\QueryParams;

class QueryParams
{
    protected $includes = [];

    protected $queryParams = [];

    protected function add(string $key, int|string $value)
    {
        $this->queryParams[$key] = $value;

        return $this;
    }

    protected function include(string $name)
    {
        $this->includes[] = $name;

        return $this;
    }

    public function all()
    {
        $this->add('include', implode(',', $this->includes));

        return $this->queryParams;
    }
}
