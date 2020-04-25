<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Badge;

trait ManagesBadges
{
    public function playerBadges(string $customPlayerId): array
    {
        return $this->transformCollection(
            $this->get("players/{$customPlayerId}/badges")['data'],
            Badge::class
        );
    }
}
