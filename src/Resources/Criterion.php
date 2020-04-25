<?php

namespace R4nkt\PhpSdk\Resources;

class Criterion extends ApiResource
{
    /**
     * Delete the given criterion.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteCriterion($this->custom_id);
    }

    // /**
    //  * Get the broken links for this criterion.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->custom_id);
    // }
}
