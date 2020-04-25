<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Action;

trait ManagesActions
{
    public function actions(): array
    {
        return $this->transformCollection(
            $this->get('actions')['data'],
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
