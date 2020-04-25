<?php

namespace R4nkt\PhpSdk\Actions;

use R4nkt\PhpSdk\Resources\Player;

trait ManagesPlayers
{
    public function players(): array
    {
        return $this->transformCollection(
            $this->get('players')['data'],
            Player::class
        );
    }

    public function player(string $customPlayerId): Player
    {
        $playerAttributes = $this->get("players/{$customPlayerId}");

        return new Player($playerAttributes['data'], $this);
    }

    public function createPlayer(array $data): Player
    {
        $playerAttributes = $this->post('players', $data);

        return new Player($playerAttributes['data'], $this);
    }

    public function deletePlayer(string $customPlayerId)
    {
        $this->delete("players/{$customPlayerId}");
    }
}
