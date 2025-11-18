<?php

class Encounter
{
    public const RESULT_WINNER = 1;
    public const RESULT_LOSER = -1;
    public const RESULT_DRAW = 0;

    public const RESULT_POSSIBILITIES = [
        self::RESULT_WINNER,
        self::RESULT_LOSER,
        self::RESULT_DRAW,
    ];

    public const K_FACTOR = 32;

    public static function probabilityAgainst(int $levelPlayerOne, int $againstLevelPlayerTwo): float
    {
        return 1 / (1 + (10 ** (($againstLevelPlayerTwo - $levelPlayerOne) / 400)));
    }

    public static function setNewLevel(int &$levelPlayerOne, int $againstLevelPlayerTwo, int $playerOneResult): void
    {
        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES, true)) {
            trigger_error(
                sprintf(
                    'Invalid result. Expected %s',
                    implode(' or ', self::RESULT_POSSIBILITIES)
                )
            );
        }

        $expectedScore = self::probabilityAgainst($levelPlayerOne, $againstLevelPlayerTwo);

        $levelPlayerOne += (int) (self::K_FACTOR * ($playerOneResult - $expectedScore));
    }
}

class Player
{
    private int $level;

    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }
}

$greg = new Player(400);
$jade = new Player(800);

echo sprintf(
    'Greg a %.2f%% de chance de gagner face à Jade',
    Encounter::probabilityAgainst($greg->getLevel(), $jade->getLevel()) * 100
) . PHP_EOL;

Encounter::setNewLevel($greg->getLevel(), $jade->getLevel(), Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade->getLevel(), $greg->getLevel(), Encounter::RESULT_LOSER);

$greg->setLevel($greg->getLevel());
$jade->setLevel($jade->getLevel());

echo sprintf(
    'Les niveaux des joueurs ont évolué vers %s pour Greg et %s pour Jade',
    $greg->getLevel(),
    $jade->getLevel()
);
