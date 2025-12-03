<?php

declare(strict_types=1);

namespace App\MatchMaker\Lobby;

use App\MatchMaker\Player\PlayerInterface;
use App\MatchMaker\Queue\QueuingPlayerInterface;

interface LobbyInterface
{
    public function findOponents(QueuingPlayerInterface $player): array;
    public function addPlayer(PlayerInterface $player): void;
    public function addPlayers(PlayerInterface ...$players): void;
}
