<?php

namespace R4nkt\PhpSdk\QueryParams;

trait AllowsPagination
{
    public function paginate(int $pageNumber, int $pageSize)
    {
        $this->pageNumber($pageNumber);
        $this->pageSize($pageSize);

        return $this;
    }

    public function pageNumber(int $pageNumber)
    {
        $this->add('page[number]', $pageNumber);

        return $this;
    }

    public function pageSize(int $pageSize)
    {
        $this->add('page[size]', $pageSize);

        return $this;
    }
}
