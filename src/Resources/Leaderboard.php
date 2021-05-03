<?php

namespace R4nkt\PhpSdk\Resources;

class Leaderboard extends ApiResource
{
    protected string $custom_id;

    /**
     * Delete this leaderboard.
     */
    public function delete(): void
    {
        $this->r4nkt->deleteLeaderboard($this->custom_id);
    }

    /**
     * Get this leaderboard's rankings
     */
    public function rankings(): ApiResourceCollection
    {
        return $this->r4nkt->leaderboardRankings($this->custom_id);
    }

    /**
     * Submit a player score for this leaderboard.
     */
    public function submitPlayerScore(string $customPlayerId, int $score, string $dateTimeUtc = null): Score
    {
        return $this->r4nkt->submitPlayerScore($customPlayerId, $this->custom_id, $score, $dateTimeUtc);
    }
}
