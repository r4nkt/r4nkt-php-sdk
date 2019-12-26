<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Reward;

trait ManagesRewards
{
    public function rewards(): array
    {
        return $this->transformCollection(
            $this->get('rewards')['data'],
            Reward::class
        );
    }

    public function reward(string $customRewardId): Reward
    {
        $rewardAttributes = $this->get("rewards/{$customRewardId}");

        return new Reward($rewardAttributes['data'], $this);
    }

    public function createReward(array $data): Reward
    {
        $rewardAttributes = $this->post('rewards', $data);

        return new Reward($rewardAttributes['data'], $this);
    }

    public function deleteReward(string $customRewardId)
    {
        $this->delete("rewards/{$customRewardId}");
    }
}
