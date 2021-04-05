<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Activity;

trait ManagesActivities
{
    public function reportActivity(
        string $customPlayerId,
        string $customActionId,
        int $amount = 1,
        ?array $customData = null,
        ?string $customSessionId = null,
        ?string $dateTimeUtc = null,
        ?string $modifier = null
    ): Activity {
        $data = [
            'custom_player_id' => $customPlayerId,
            'custom_action_id' => $customActionId,
        ];

        if ($amount) {
            $data['amount'] = $amount;
        }
        if ($customData) {
            $data['custom_data'] = json_encode($customData);
        }
        if ($customSessionId) {
            $data['custom_session_id'] = $customSessionId;
        }
        if ($dateTimeUtc) {
            $data['date_time_utc'] = $dateTimeUtc;
        }
        if ($modifier) {
            $data['modifier'] = $modifier;
        }

        $activityAttributes = $this->post('activities', $data);

        return new Activity($activityAttributes['data'], $this);
    }
}
