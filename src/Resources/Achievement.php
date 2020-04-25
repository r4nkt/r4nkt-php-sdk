<?php

namespace R4nkt\PhpSdk\Resources;

class Achievement extends ApiResource
{
    /**
     * Update the given achievement.
     *
     * @return void
     */
    public function update(array $data)
    {
        return $this->r4nkt->updateAchievement($this->custom_id, $data);
    }

    /**
     * Delete the given achievement.
     *
     * @return void
     */
    public function delete()
    {
        $this->r4nkt->deleteAchievement($this->custom_id);
    }

    /**
     * Get the rewards for this achievement.
     *
     * @return array
     */
    public function rewards()
    {
        return $this->r4nkt->achievementRewards($this->custom_id);
    }

    /**
     * Attach a reward to this achievement.
     *
     * @param  string $customRewardId [description]
     * @return \R4nkt\PhpSdk\Resources\Reward
     */
    public function attachReward(string $customRewardId)
    {
        return $this->r4nkt->attachRewardToAchievement($this->custom_id, $customRewardId);
    }

    /**
     * Detach a reward from this achievement.
     *
     * @return void
     */
    public function detachReward(string $customRewardId)
    {
        $this->r4nkt->detachRewardFromAchievement($this->custom_id, $customRewardId);
    }
}
