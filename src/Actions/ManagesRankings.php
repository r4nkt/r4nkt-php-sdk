<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Ranking;

trait ManagesRankings
{
    public function leaderboardRankings(string $customLeaderboardId): array
    {
        return $this->transformCollection(
            $this->get("leaderboards/{$customLeaderboardId}/rankings")['data'],
            Ranking::class
        );
    }

    public function leaderboardPlayerRankings(string $customLeaderboardId, string $customPlayerId): array
    {
        return $this->transformCollection(
            $this->get("leaderboards/{$customLeaderboardId}/players/{$customPlayerId}/rankings")['data'],
            Ranking::class
        );
    }
}
