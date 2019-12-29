<?php

namespace R4nkt\PhpSdk\Resources;

class Leaderboard extends ApiResource
{
    /**
     * Delete the given leaderboard.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteLeaderboard($this->customId);
    }

    // /**
    //  * Get the broken links for this leaderboard.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->customId);
    // }
}
