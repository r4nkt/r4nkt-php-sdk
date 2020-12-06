<?php

namespace R4nkt\PhpSdk\QueryParams;

class BadgesParams extends QueryParams
{
    use AllowsPagination;

    public function includeAchievement()
    {
        $this->include('achievement');

        return $this;
    }

    public function includePlayer()
    {
        $this->include('player');

        return $this;
    }
}
