<?php

namespace R4nkt\PhpSdk\Resources;

class Reward extends ApiResource
{
    protected string $custom_id;

    /**
     * Delete the given reward.
     */
    public function delete(): void
    {
        $this->r4nkt->deleteReward($this->custom_id);
    }
}
