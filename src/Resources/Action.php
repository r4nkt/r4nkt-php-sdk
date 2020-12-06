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
        $this->r4nkt->deleteAction($this->custom_id);
    }

    /**
     * Get the reactions for this action.
     *
     * @return array
     */
    public function reactions()
    {
        return $this->r4nkt->actionReactions($this->custom_id);
    }
}
