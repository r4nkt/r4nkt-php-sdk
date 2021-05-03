<?php

namespace R4nkt\PhpSdk\Resources;

class CriteriaGroup extends ApiResource
{
    protected string $custom_id;

    /**
     * Delete the given criteria group.
     */
    public function delete(): void
    {
        $this->r4nkt->deleteCriteriaGroup($this->custom_id);
    }

    /**
     * Get the criteria for this criteria group.
     */
    public function criteria(): ApiResourceCollection
    {
        return $this->r4nkt->criteriaGroupCriteria($this->custom_id);
    }

    /**
     * Attach a criterion to this criteria group.
     */
    public function attachCriterion(string $customCriterionId): Criterion
    {
        return $this->r4nkt->attachCriterionToCriteriaGroup($this->custom_id, $customCriterionId);
    }

    /**
     * Detach a criterion from this criteria group.
     */
    public function detachCriterion(string $customCriterionId): void
    {
        $this->r4nkt->detachCriterionFromCriteriaGroup($this->custom_id, $customCriterionId);
    }
}
