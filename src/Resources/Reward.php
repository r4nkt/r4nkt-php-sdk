<?php

namespace R4nkt\PhpSdk\Resources;

class Reward extends ApiResource
{
    /**
     * Delete the given reward.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteReward($this->customId);
    }

    // /**
    //  * Get the broken links for this reward.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->customId);
    // }
}