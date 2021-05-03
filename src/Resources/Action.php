<?php

namespace R4nkt\PhpSdk\Resources;

class Action extends ApiResource
{
    protected string $custom_id;

    /**
     * Delete the given action.
     */
    public function delete(): void
    {
        $this->r4nkt->deleteAction($this->custom_id);
    }

    /**
     * Get the reactions for this action.
     */
    public function reactions(): ApiResourceCollection
    {
        return $this->r4nkt->actionReactions($this->custom_id);
    }
}
