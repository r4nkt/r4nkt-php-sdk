<?php

namespace R4nkt\PhpSdk\Resources;

class Achievement extends ApiResource
{
    /**
     * Delete the given achievement.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteAchievement($this->customId);
    }

    /**
     * Get the rewards for this achievement.
     *
     * @return array
     */
    public function rewards()
    {
        return $this->r4nkt->achievementRewards($this->customId);
    }

    /**
     * Attach a reward to this achievement.
     *
     * @param  string $customRewardId [description]
     * @return \R4nkt\PhpSdk\Resources\Reward
     */
    public function attachReward(string $customRewardId)
    {
        return $this->r4nkt->attachRewardToAchievement($this->customId, $customRewardId);
    }

    /**
     * Detach a reward from this achievement.
     *
     * @return void
     */
    public function detachReward(string $customRewardId)
    {
        $this->r4nkt->detachRewardFromAchievement($this->customId, $customRewardId);
    }
}
