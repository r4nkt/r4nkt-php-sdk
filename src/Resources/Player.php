<?php

namespace R4nkt\PhpSdk\Resources;

class Player extends ApiResource
{
    protected string $custom_id;

    /**
     * Delete the given reward.
     */
    public function delete(): void
    {
        $this->r4nkt->deletePlayer($this->custom_id);
    }

    public function reportActivity(
        string $customActionId,
        int $amount = 1,
        ?array $customData = null,
        ?string $session = null,
        ?string $dateTimeUtc = null,
        ?string $modifier = null
    ): Activity {
        return $this->r4nkt->reportActivity(
            $this->custom_id,
            $customActionId,
            $amount,
            $customData,
            $session,
            $dateTimeUtc,
            $modifier,
        );
    }

    public function leaderboardRankings(string $customLeaderboardId): ApiResourceCollection
    {
        return $this->r4nkt->leaderboardPlayerRankings($customLeaderboardId, $this->custom_id);
    }
}
