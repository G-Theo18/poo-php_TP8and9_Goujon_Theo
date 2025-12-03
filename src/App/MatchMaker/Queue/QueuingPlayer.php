<?php

declare(strict_types=1);

namespace App\MatchMaker\Queue;

use App\MatchMaker\Player\Player;

class QueuingPlayer extends Player implements QueuingPlayerInterface
{
    private int $range = 1;
    private \DateTimeImmutable $queuedAt;

    public function __construct(string $name, float $ratio = 400.0)
    {
        parent::__construct($name, $ratio);
        $this->queuedAt = new \DateTimeImmutable();
    }

    public function getQueuedAt(): \DateTimeImmutable
    {
        return $this->queuedAt;
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function upgradeRange(): void
    {
        $this->range = min($this->range + 1, 40);
    }
}
