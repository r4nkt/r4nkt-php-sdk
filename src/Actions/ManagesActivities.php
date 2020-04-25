<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Activity;

trait ManagesActivities
{
    // public function activities() : array
    // {
    //     return $this->transformCollection(
    //         $this->get('activities')['data'],
    //         Activity::class
    //     );
    // }

    // public function activity(string $customActivityId) : Activity
    // {
    //     $activityAttributes = $this->get("activities/{$customActivityId}");

    //     return new Activity($activityAttributes['data'], $this);
    // }

    public function reportActivity(
        string $customPlayerId,
        string $customActionId,
        int $amount = 1,
        ?string $session = null,
        ?string $dateTimeUtc = null,
        ?string $modifier = null
    ) : Activity
    {
        $data = [
            'custom_player_id' => $customPlayerId,
            'custom_action_id' => $customActionId,
        ];

        if ($amount) {
            $data['amount'] = $amount;
        }
        if ($session) {
            $data['session'] = $session;
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

    // public function createActivity(array $data) : Activity
    // {
    //     $activityAttributes = $this->post('activities', $data);

    //     return new Activity($activityAttributes['data'], $this);
    // }

    // public function deleteActivity(string $customActivityId) : void
    // {
    //     $this->delete("activities/{$customActivityId}");
    // }
}