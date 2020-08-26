<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Action;
use R4nkt\PhpSdk\Resources\ApiResourceCollection;

trait ManagesActions
{
    public function actions(): ApiResourceCollection
    {
        return $this->buildCollection(
            $this->get('actions'),
            Action::class
        );
    }

    public function action(string $customActionId): Action
    {
        $actionAttributes = $this->get("actions/{$customActionId}");

        return new Action($actionAttributes['data'], $this);
    }

    public function createAction(array $data): Action
    {
        $actionAttributes = $this->post('actions', $data);

        return new Action($actionAttributes['data'], $this);
    }

    public function deleteAction(string $customActionId): void
    {
        $this->delete("actions/{$customActionId}");
    }
}
