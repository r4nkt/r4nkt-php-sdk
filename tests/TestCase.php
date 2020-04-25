<?php

namespace R4nkt\PhpSdk\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use R4nkt\PhpSdk\R4nkt;

class TestCase extends BaseTestCase
{
    protected $r4nkt;

    public function setUp() : void
    {
        $this->r4nkt = new R4nkt($_SERVER['R4NKT_API_TOKEN'], $_SERVER['R4NKT_GAME_ID']);
    }

    protected function clearResources(array $resources) : void
    {
        foreach ($resources as $resource) {
            $resource->delete();
        }
    }

    protected function createAchievement(string $customId, ?string $name = null, ?string $description = null, ?string $customCriteriaGroupId = null)
    {
        $name = $name ?? ('name' . uniqid());
        $description = $description ?? ('description' . uniqid());

        return $this->r4nkt->createAchievement([
            'custom_id' => $customId,
            'name' => $name,
            'description' => $description,
            'custom_criteria_group_id' => $customCriteriaGroupId,
        ]);
    }

    protected function createAction(string $customId, ?string $name = null, ?string $description = null)
    {
        $name = $name ?? ('name' . uniqid());
        $description = $description ?? ('description' . uniqid());

        return $this->r4nkt->createAction([
            'custom_id' => $customId,
            'name' => $name,
            'description' => $description,
        ]);
    }

    protected function createCriteriaGroup(string $customId, ?string $name = null, ?string $description = null)
    {
        $name = $name ?? ('name' . uniqid());
        $description = $description ?? ('description' . uniqid());

        return $this->r4nkt->createCriteriaGroup([
            'custom_id' => $customId,
            'name' => $name,
            'description' => $description,
        ]);
    }

    protected function createCriterion(string $customId, string $customActionId, ?string $name = null, ?string $description = null)
    {
        $name = $name ?? ('name' . uniqid());
        $description = $description ?? ('description' . uniqid());

        return $this->r4nkt->createCriterion([
            'custom_id' => $customId,
            'custom_action_id' => $customActionId,
            'name' => $name,
            'description' => $description,
        ]);
    }

    protected function createReward(string $customId, ?string $name = null, ?string $description = null)
    {
        $name = $name ?? ('name' . uniqid());
        $description = $description ?? ('description' . uniqid());

        return $this->r4nkt->createReward([
            'custom_id' => $customId,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
