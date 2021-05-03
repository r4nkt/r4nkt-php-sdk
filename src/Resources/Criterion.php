<?php

namespace R4nkt\PhpSdk\Resources;

class Criterion extends ApiResource
{
    protected string $custom_id;

    /**
     * Delete the given criterion.
     */
    public function delete(): void
    {
        $this->r4nkt->deleteCriterion($this->custom_id);
    }
}
