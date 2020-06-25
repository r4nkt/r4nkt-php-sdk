<?php

namespace R4nkt\PhpSdk\Tests;

use R4nkt\PhpSdk\Exceptions\NotFoundException;

class BadgesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->clearResources($this->r4nkt->achievements());
        $this->clearResources($this->r4nkt->actions());
        $this->clearResources($this->r4nkt->criteriaGroups());
        $this->clearResources($this->r4nkt->criteria());
    }

    /** @test */
    public function it_cannot_get_badges_for_a_nonexistent_player()
    {
        $this->expectException(NotFoundException::class);

        $this->r4nkt->playerBadges('nonexistent.player');
    }

    /** @test */
    public function it_can_get_badges_for_an_existing_player()
    {
        $action = $this->createAction('action.a');
        $criterion = $this->createCriterion('criterion.a', $action->custom_id);
        $criteriaGroup = $this->createCriteriaGroup('criteria-group.a');
        $criteriaGroup->attachCriterion($criterion->custom_id);
        $achievement = $this->createAchievement('achievement.a', null, null, $criteriaGroup->custom_id);

        $activity = $this->r4nkt->reportActivity('custom.player.id', $action->custom_id);
        usleep(1000000); // a second should allow sufficient time for the badge to be awarded
        $badges = $this->r4nkt->playerBadges('custom.player.id');

        $this->assertCount(1, $badges);
    }
}
