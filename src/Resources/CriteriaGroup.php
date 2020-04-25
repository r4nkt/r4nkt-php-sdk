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
        $this->r4nkt->deleteCriteriaGroup($this->custom_id);
    }

    /**
     * Get the criteria for this criteria group.
     *
     * @return array
     */
    public function criteria()
    {
        return $this->r4nkt->criteriaGroupCriteria($this->custom_id);
    }

    /**
     * Attach a criterion to this criteria group.
     *
     * @param  string $customCriterionId [description]
     * @return \R4nkt\PhpSdk\Resources\Criterion
     */
    public function attachCriterion(string $customCriterionId)
    {
        return $this->r4nkt->attachCriterionToCriteriaGroup($this->custom_id, $customCriterionId);
    }

    /**
     * Detach a criterion from this criteria group.
     *
     * @return void
     */
    public function detachCriterion(string $customCriterionId)
    {
        $this->r4nkt->detachCriterionFromCriteriaGroup($this->custom_id, $customCriterionId);
    }
}
