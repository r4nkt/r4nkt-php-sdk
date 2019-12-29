<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Criterion;

trait ManagesCriteria
{
    public function criteria(): array
    {
        return $this->transformCollection(
            $this->get('criteria')['data'],
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
