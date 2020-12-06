<?php

namespace R4nkt\PhpSdk\QueryParams;

class AchievementsParams extends QueryParams
{
    use AllowsPagination;

    public function withSecret()
    {
        $this->add('filter[secret]', 'with');

        return $this;
    }

    public function withoutSecret()
    {
        $this->add('filter[secret]', 'without');

        return $this;
    }

    public function onlySecret()
    {
        $this->add('filter[secret]', 'only');

        return $this;
    }
}
