<?php

declare(strict_types=1);

namespace App\MatchMaker\Queue;

use App\MatchMaker\Player\PlayerInterface;

interface QueuingPlayerInterface extends PlayerInterface
{
    public function getRange(): int;
    public function upgradeRange(): void;
}
