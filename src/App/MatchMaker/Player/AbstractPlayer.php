<?php

declare(strict_types=1);

namespace App\MatchMaker\Player;

abstract class AbstractPlayer
{
    public function __construct(
        public string $name = 'anonymous',
        public float $ratio = 400.0,
    ) {}
}
