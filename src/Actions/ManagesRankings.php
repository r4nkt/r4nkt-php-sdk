<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Ranking;

trait ManagesRankings
{
    public function leaderboardRankings(string $customLeaderboardId): array
    {
        $response = $this->get("leaderboards/{$customLeaderboardId}/rankings");

        return [
            'data' => $this->transformCollection($response['data'], Ranking::class),
            'links' => $response['links'],
            'meta' => $response['meta'],
        ];
    }

    public function leaderboardPlayerRankings(string $customLeaderboardId, string $customPlayerId): array
    {
        $response = $this->get("leaderboards/{$customLeaderboardId}/players/{$customPlayerId}/rankings");

        return [
            'data' => $this->transformCollection($response['data'], Ranking::class),
            'links' => $response['links'],
            'meta' => $response['meta'],
        ];
    }
}
