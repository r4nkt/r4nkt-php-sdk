<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\CriteriaGroup;

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
}
