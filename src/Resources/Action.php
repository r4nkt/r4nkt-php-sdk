<?php

namespace R4nkt\PhpSdk\Resources;

class Action extends ApiResource
{
    /**
     * Delete the given action.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteAction($this->customId);
    }

    // /**
    //  * Get the broken links for this action.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->customId);
    // }
}
