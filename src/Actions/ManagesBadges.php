<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\ApiResourceCollection;
use R4nkt\PhpSdk\Resources\Badge;

trait ManagesBadges
{
    public function playerBadges(string $customPlayerId): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get("players/{$customPlayerId}/badges"),
            Badge::class
        );
    }
}
