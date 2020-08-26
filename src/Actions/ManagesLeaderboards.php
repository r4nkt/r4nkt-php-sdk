<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\ApiResourceCollection;
use R4nkt\PhpSdk\Resources\Leaderboard;

trait ManagesLeaderboards
{
    public function leaderboards(): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get('leaderboards'),
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
}
