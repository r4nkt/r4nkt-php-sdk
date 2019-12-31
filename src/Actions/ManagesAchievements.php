<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Reward;
use R4nkt\PhpSdk\Resources\Achievement;

trait ManagesAchievements
{
    public function achievements(): array
    {
        return $this->transformCollection(
            $this->get('achievements')['data'],
            Achievement::class
        );
    }

    public function achievement(string $customAchievementId): Achievement
    {
        $achievementAttributes = $this->get("achievements/{$customAchievementId}");

        return new Achievement($achievementAttributes['data'], $this);
    }

    public function createAchievement(array $data): Achievement
    {
        $achievementAttributes = $this->post('achievements', $data);

        return new Achievement($achievementAttributes['data'], $this);
    }

    public function deleteAchievement(string $customAchievementId)
    {
        $this->delete("achievements/{$customAchievementId}");
    }

    public function attachRewardToAchievement(string $customAchievementId, string $customRewardId)
    {
        $data = ['custom_reward_id' => $customRewardId];
        $rewardAttributes = $this->post("achievements/{$customAchievementId}/rewards", $data);

        return new Reward($rewardAttributes['data'], $this);
    }

    public function detachRewardFromAchievement(string $customAchievementId, string $customRewardId)
    {
        $this->delete("achievements/{$customAchievementId}/rewards/{$customRewardId}");
    }

    public function achievementRewards(string $customAchievementId): array
    {
        return $this->transformCollection(
            $this->get("achievements/{$customAchievementId}/rewards")['data'],
            Achievement::class
        );
    }
}
