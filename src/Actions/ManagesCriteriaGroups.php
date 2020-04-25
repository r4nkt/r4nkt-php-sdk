<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\CriteriaGroup;
use R4nkt\PhpSdk\Resources\Criterion;

trait ManagesCriteriaGroups
{
    public function criteriaGroups(): array
    {
        return $this->transformCollection(
            $this->get('criteria-groups')['data'],
            CriteriaGroup::class
        );
    }

    public function criteriaGroup(string $customCriteriaGroupId): CriteriaGroup
    {
        $criteriaGroupAttributes = $this->get("criteria-groups/{$customCriteriaGroupId}");

        return new CriteriaGroup($criteriaGroupAttributes['data'], $this);
    }

    public function createCriteriaGroup(array $data): CriteriaGroup
    {
        $criteriaGroupAttributes = $this->post('criteria-groups', $data);

        return new CriteriaGroup($criteriaGroupAttributes['data'], $this);
    }

    public function deleteCriteriaGroup(string $customCriteriaGroupId)
    {
        $this->delete("criteria-groups/{$customCriteriaGroupId}");
    }

    public function attachCriterionToCriteriaGroup(string $customCriteriaGroupId, string $customCriterionId) : Criterion
    {
        $data = ['custom_criterion_id' => $customCriterionId];
        $criterionAttributes = $this->post("criteria-groups/{$customCriteriaGroupId}/criteria", $data);

        return new Criterion($criterionAttributes['data'], $this);
    }

    public function detachCriterionFromCriteriaGroup(string $customCriteriaGroupId, string $customCriterionId)
    {
        $this->delete("criteria-groups/{$customCriteriaGroupId}/criteria/{$customCriterionId}");
    }

    public function achievementCriteria(string $customCriteriaGroupId): array
    {
        return $this->transformCollection(
            $this->get("criteria-groups/{$customCriteriaGroupId}/criteria")['data'],
            CriteriaGroup::class
        );
    }
}
