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
     * @return array
     */
    public function rankings(): array
    {
        return $this->r4nkt->leaderboardRankings($this->custom_id);
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
