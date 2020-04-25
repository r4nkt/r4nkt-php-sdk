<?php

namespace R4nkt\PhpSdk\Tests;

use R4nkt\PhpSdk\Exceptions\NotFoundException;

class RewardsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // clear existing rewards
        $this->clearResources($this->r4nkt->rewards());
    }

    /** @test */
    public function it_can_get_rewards_when_there_are_none()
    {
        $this->assertCount(0, $this->r4nkt->rewards());
    }

    /** @test */
    public function it_can_create_a_reward()
    {
        $customId = 'test.customId';
        $name = 'test.name';
        $description = 'test.description';

        $reward = $this->createReward($customId, $name, $description);

        $this->assertSame($customId, $reward->custom_id);
        $this->assertSame($name, $reward->name);
        $this->assertSame($description, $reward->description);
    }

    /** @test */
    public function it_can_get_rewards()
    {
        $expectedCustomIds = [
            'reward.a',
            'reward.b',
            'reward.c',
        ];
        foreach ($expectedCustomIds as $customId) {
            $this->createReward($customId);
        }

        $rewards = $this->r4nkt->rewards();

        $this->assertCount(count($expectedCustomIds), $rewards);
        foreach ($rewards as $reward) {
            $this->assertContains($reward->custom_id, $expectedCustomIds);
        }
    }

    /** @test */
    public function it_can_get_a_reward()
    {
        $expectedCustomIds = [
            'reward.a',
            'reward.b',
            'reward.c',
        ];
        foreach ($expectedCustomIds as $customId) {
            $this->createReward($customId);
        }

        $reward = $this->r4nkt->reward('reward.b');

        $this->assertSame('reward.b', $reward->custom_id);
    }

    /** @test */
    public function it_cannot_get_a_nonexistent_reward()
    {
        $this->expectException(NotFoundException::class);

        $this->r4nkt->reward('nonexistent.reward');
    }

    /** @test */
    public function it_can_get_delete_a_reward_via_r4nkt()
    {
        $customId = 'reward.a';
        $reward = $this->createReward($customId);

        $this->r4nkt->deleteReward($reward->custom_id);

        $this->assertCount(0, $this->r4nkt->rewards());
    }

    /** @test */
    public function a_reward_can_delete_itself()
    {
        $customId = 'reward.a';
        $reward = $this->createReward($customId);

        $reward->delete();

        $this->assertCount(0, $this->r4nkt->rewards());
    }
}
