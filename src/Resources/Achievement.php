<?php

namespace R4nkt\PhpSdk\Resources;

class Achievement extends ApiResource
{
    /**
     * Delete the given achievement.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteAchievement($this->customId);
    }

    // /**
    //  * Get the broken links for this achievement.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->customId);
    // }
}
