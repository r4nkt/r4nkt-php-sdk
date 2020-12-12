<?php

namespace R4nkt\PhpSdk\QueryParams;

class AchievementsParams extends QueryParams
{
    use AllowsPagination;

    public function withSecrets()
    {
        $this->add('filter[secret]', 'with');

        return $this;
    }

    public function withoutSecrets()
    {
        $this->add('filter[secret]', 'without');

        return $this;
    }

    public function onlySecrets()
    {
        $this->add('filter[secret]', 'only');

        return $this;
    }
}
