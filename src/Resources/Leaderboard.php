<?php

namespace R4nkt\PhpSdk\Resources;

class Leaderboard extends ApiResource
{
    /**
     * Delete this leaderboard.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->r4nkt->deleteLeaderboard($this->custom_id);
    }

    /**
     * Get this leaderboard's rankings
     *
     * @return ApiResourceCollection
     */
    public function rankings(): ApiResourceCollection
    {
        return $this->r4nkt->leaderboardRankings($this->custom_id);
    }

    /**
     * Submit a player score for this leaderboard.
     *
     * @param  string $customPlayerId [description]
     * @param  int    $score          [description]
     * @return [type]                 [description]
     */
    public function submitPlayerScore(string $customPlayerId, int $score, string $dateTimeUtc = null)
    {
        return $this->r4nkt->submitPlayerScore($customPlayerId, $this->custom_id, $score, $dateTimeUtc);
    }

    // /**
    //  * Get the broken links for this leaderboard.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->custom_id);
    // }
}
