<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Leaderboard;

trait ManagesLeaderboards
{
    public function leaderboards(): array
    {
        return $this->transformCollection(
            $this->get('leaderboards')['data'],
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

    public function leaderboardRankings(string $customLeaderboardId): array
    {
        return $this->get("leaderboards/{$customLeaderboardId}/rankings");
    }
}
