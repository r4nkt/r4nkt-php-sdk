<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\QueryParams\LeaderboardsParams;
use R4nkt\PhpSdk\Resources\ApiResourceCollection;
use R4nkt\PhpSdk\Resources\Leaderboard;
use R4nkt\PhpSdk\Resources\Score;

trait ManagesLeaderboards
{
    public function leaderboards(LeaderboardsParams $params = null): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get('leaderboards', $params),
            Leaderboard::class
        );
    }

    public function leaderboard(string $customLeaderboardId): Leaderboard
    {
        $leaderboardAttributes = $this->get("leaderboards/{$customLeaderboardId}");

        return new Leaderboard($leaderboardAttributes['data'], $this);
    }

    public function createLeaderboard(array $data): Leaderboard
    {
        $leaderboardAttributes = $this->post('leaderboards', $data);

        return new Leaderboard($leaderboardAttributes['data'], $this);
    }

    public function deleteLeaderboard(string $customLeaderboardId)
    {
        $this->delete("leaderboards/{$customLeaderboardId}");
    }

    public function submitPlayerScore(string $customPlayerId, string $customLeaderboardId, int $score, string $dateTimeUtc = null)
    {
        $data = [
            'custom_player_id' => $customPlayerId,
            'custom_leaderboard_id' => $customLeaderboardId,
            'score' => $score,
        ];

        if ($dateTimeUtc) {
            $data['date_time_utc'] = $dateTimeUtc;
        }

        $newScoreAttributes = $this->post('scores', $data);

        return new Score($newScoreAttributes['data'], $this);
    }
}
