<?php

namespace R4nkt\PhpSdk\Resources;

class Player extends ApiResource
{
    /**
     * Delete the given reward.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deletePlayer($this->custom_id);
    }

    public function reportActivity(
        string $customActionId,
        int $amount = 1,
        ?string $session = null,
        ?string $dateTimeUtc = null,
        ?string $modifier = null,
    ) : Activity
    {
        return $this->r4nkt->reportActivity($this->custom_id, $customActionId, $amount, $session, $dateTimeUtc, $modifier);
    }

    // /**
    //  * Get the broken links for this reward.
    //  *
    //  * @return array
    //  */
    // public function brokenLinks()
    // {
    //     return $this->r4nkt->brokenLinks($this->custom_id);
    // }
}
