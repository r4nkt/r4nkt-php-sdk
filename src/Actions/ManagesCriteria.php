<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\ApiResourceCollection;
use R4nkt\PhpSdk\Resources\Criterion;

trait ManagesCriteria
{
    public function criteria(): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get('criteria'),
            Criterion::class
        );
    }

    public function criterion(string $customCriterionId): Criterion
    {
        $criterionAttributes = $this->get("criteria/{$customCriterionId}");

        return new Criterion($criterionAttributes['data'], $this);
    }

    public function createCriterion(array $data): Criterion
    {
        $criterionAttributes = $this->post('criteria', $data);

        return new Criterion($criterionAttributes['data'], $this);
    }

    public function deleteCriterion(string $customCriterionId)
    {
        $this->delete("criteria/{$customCriterionId}");
    }
}
