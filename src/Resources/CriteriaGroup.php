<?php

namespace R4nkt\PhpSdk\Resources;

class CriteriaGroup extends ApiResource
{
    /**
     * Delete the given criteria group.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteCriteriaGroup($this->customId);
    }

    // /**
    //  * Get the broken links for this criteria group.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->customId);
    // }
}
