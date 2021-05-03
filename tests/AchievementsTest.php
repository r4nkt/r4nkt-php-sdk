<?php

namespace R4nkt\PhpSdk\Tests;

use R4nkt\PhpSdk\Exceptions\NotFoundException;

class AchievementsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // clear existing achievements
        $this->clearResources($this->r4nkt->achievements());

        // clear existing criteria groups
        $this->clearResources($this->r4nkt->criteriaGroups());

        // clear existing rewards
        $this->clearResources($this->r4nkt->rewards());
    }

    /** @test */
    public function it_can_get_achievements_when_there_are_none()
    {
        $this->assertCount(0, $this->r4nkt->achievements());
    }

    /** @test */
    public function it_can_create_an_achievement()
    {
        $customId = 'test.customId';
        $name = 'test.name';
        $description = 'test.description';

        $achievement = $this->createAchievement($customId, $name, $description);

        $this->assertSame($customId, $achievement->custom_id);
        $this->assertSame($name, $achievement->name);
        $this->assertSame($description, $achievement->description);
    }

    /** @test */
    public function it_can_get_achievements()
    {
        $expectedCustomIds = [
            'achievement.a',
            'achievement.b',
            'achievement.c',
        ];
        foreach ($expectedCustomIds as $customId) {
            $this->createAchievement($customId);
        }

        $achievements = $this->r4nkt->achievements();

        $this->assertCount(count($expectedCustomIds), $achievements);
        foreach ($achievements as $achievement) {
            $this->assertContains($achievement->custom_id, $expectedCustomIds);
        }
    }

    /** @test */
    public function it_can_get_an_achievement()
    {
        $expectedCustomIds = [
            'achievement.a',
            'achievement.b',
            'achievement.c',
        ];
        foreach ($expectedCustomIds as $customId) {
            $this->createAchievement($customId);
        }

        $achievement = $this->r4nkt->achievement('achievement.b');

        $this->assertSame('achievement.b', $achievement->custom_id);
    }

    /** @test */
    public function it_cannot_get_a_nonexistent_achievement()
    {
        $this->expectException(NotFoundException::class);

        $this->r4nkt->achievement('nonexistent.achievement');
    }

    /** @test */
    public function it_can_get_delete_an_achievement_via_r4nkt()
    {
        $customId = 'achievement.a';
        $achievement = $this->createAchievement($customId);

        $this->r4nkt->deleteAchievement($achievement->custom_id);

        $this->assertCount(0, $this->r4nkt->achievements());
    }

    /** @test */
    public function an_achievement_can_delete_itself()
    {
        $customId = 'achievement.a';
        $achievement = $this->createAchievement($customId);

        $achievement->delete();

        $this->assertCount(0, $this->r4nkt->achievements());
    }

    /** @test */
    public function it_can_get_update_an_achievement_via_r4nkt()
    {
        $customId = 'achievement.a';
        $achievement = $this->createAchievement($customId);

        $name = 'name'.uniqid();
        $description = 'description'.uniqid();

        $achievement = $this->r4nkt->updateAchievement($achievement->custom_id, [
            'name' => $name,
            'description' => $description,
        ]);

        $this->assertSame($customId, $achievement->custom_id);
        $this->assertSame($name, $achievement->name);
        $this->assertSame($description, $achievement->description);
    }

    /** @test */
    public function an_achievement_can_update_itself()
    {
        $customId = 'achievement.a';
        $achievement = $this->createAchievement($customId);

        $name = 'name'.uniqid();
        $description = 'description'.uniqid();

        $achievement = $achievement->update([
            'name' => $name,
            'description' => $description,
        ]);

        $this->assertSame($customId, $achievement->custom_id);
        $this->assertSame($name, $achievement->name);
        $this->assertSame($description, $achievement->description);
    }

    /** @test */
    public function an_achievement_can_attach_a_reward_to_itself()
    {
        $achievement = $this->createAchievement('achievement.a');
        $customId = 'reward.a';
        $reward = $this->createReward($customId);

        $reward = $achievement->attachReward($reward->custom_id);

        $this->assertSame($customId, $reward->custom_id);
    }

    /** @test */
    public function it_can_attach_a_reward_to_an_achievement()
    {
        $achievement = $this->createAchievement('achievement.a');
        $customId = 'reward.a';
        $reward = $this->createReward($customId);

        $reward = $this->r4nkt->attachRewardToAchievement($achievement->custom_id, $reward->custom_id);

        $this->assertSame($customId, $reward->custom_id);
    }

    /**
     * @test
     * @dataProvider provideCustomRewardIds
     */
    public function it_can_list_an_achievements_rewards($customRewardIds)
    {
        $achievement = $this->createAchievement('achievement.a');
        foreach ($customRewardIds as $customRewardId) {
            $this->createReward($customRewardId);
            $this->r4nkt->attachRewardToAchievement($achievement->custom_id, $customRewardId);
        }

        $rewards = $this->r4nkt->achievementRewards($achievement->custom_id);

        $this->assertCount(count($customRewardIds), $rewards);
        foreach ($rewards as $reward) {
            $this->assertContains($reward->custom_id, $customRewardIds);
        }
    }

    /**
     * @test
     * @dataProvider provideCustomRewardIds
     */
    public function an_achievement_can_list_its_rewards($customRewardIds)
    {
        $achievement = $this->createAchievement('achievement.a');
        foreach ($customRewardIds as $customRewardId) {
            $this->createReward($customRewardId);
            $this->r4nkt->attachRewardToAchievement($achievement->custom_id, $customRewardId);
        }

        $rewards = $achievement->rewards();

        $this->assertCount(count($customRewardIds), $rewards);
        foreach ($rewards as $reward) {
            $this->assertContains($reward->custom_id, $customRewardIds);
        }
    }

    public function provideCustomRewardIds()
    {
        return [
            [[]],
            [['reward.a']],
            [['reward.a', 'reward.b']],
        ];
    }

    /** @test */
    public function an_achievement_can_detach_a_reward_from_itself()
    {
        $achievement = $this->createAchievement('achievement.a');
        $customId = 'reward.a';
        $reward = $this->createReward($customId);
        $achievement->attachReward($reward->custom_id);

        $achievement->detachReward($reward->custom_id);

        $rewards = $achievement->rewards();
        $this->assertCount(0, $rewards);
    }

    /** @test */
    public function it_can_detach_a_reward_from_an_achievement()
    {
        $achievement = $this->createAchievement('achievement.a');
        $customId = 'reward.a';
        $reward = $this->createReward($customId);
        $achievement->attachReward($reward->custom_id);

        $this->r4nkt->detachRewardFromAchievement($achievement->custom_id, $reward->custom_id);

        $rewards = $achievement->rewards();
        $this->assertCount(0, $rewards);
    }
}
