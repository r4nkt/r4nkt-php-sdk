<?php

namespace R4nkt\PhpSdk\QueryParams;

class QueryParams
{
    protected $includes = [];

    protected $queryParams = [];

    /**
     * @todo Drop doc block type hints once PHP 7.x support dropped and union type hints supported.
     *
     * @param string $key
     * @param int|string $value
     */
    protected function add($key, $value)
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
