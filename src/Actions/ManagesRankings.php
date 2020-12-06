<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\QueryParams\RankingsParams;
use R4nkt\PhpSdk\Resources\ApiResourceCollection;
use R4nkt\PhpSdk\Resources\Ranking;

trait ManagesRankings
{
    public function leaderboardRankings(string $customLeaderboardId, RankingsParams $params = null): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get("leaderboards/{$customLeaderboardId}/rankings", $params),
            Ranking::class
        );
    }

    public function leaderboardPlayerRankings(string $customLeaderboardId, string $customPlayerId): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get("leaderboards/{$customLeaderboardId}/players/{$customPlayerId}/rankings"),
            Ranking::class
        );
    }
}
