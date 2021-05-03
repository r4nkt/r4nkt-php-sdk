<?php

namespace R4nkt\PhpSdk\Resources;

class Achievement extends ApiResource
{
    protected string $custom_id;

    /**
     * Update the given achievement.
     */
    public function update(array $data): self
    {
        return $this->r4nkt->updateAchievement($this->custom_id, $data);
    }

    /**
     * Delete the given achievement.
     */
    public function delete(): void
    {
        $this->r4nkt->deleteAchievement($this->custom_id);
    }

    /**
     * Get the rewards for this achievement.
     */
    public function rewards(): ApiResourceCollection
    {
        return $this->r4nkt->achievementRewards($this->custom_id);
    }

    /**
     * Attach a reward to this achievement.
     */
    public function attachReward(string $customRewardId): Reward
    {
        return $this->r4nkt->attachRewardToAchievement($this->custom_id, $customRewardId);
    }

    /**
     * Detach a reward from this achievement.
     */
    public function detachReward(string $customRewardId): void
    {
        $this->r4nkt->detachRewardFromAchievement($this->custom_id, $customRewardId);
    }
}
