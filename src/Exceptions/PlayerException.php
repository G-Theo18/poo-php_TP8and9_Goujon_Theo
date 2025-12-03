<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class PlayerException extends Exception
{
    public const INVALID_PLAYER     = 1;
    public const ALREADY_IN_GAME    = 2;
    public const NOT_FOUND          = 3;
    public const PERMISSION_DENIED  = 4;
    public const VALIDATION_ERROR   = 5;

    private ?int $httpStatus;

    public function __construct(string $message = '', int $code = 0, ?int $httpStatus = null, ?Exception $previous = null)
    {
        $this->httpStatus = $httpStatus;
        parent::__construct($message, $code, $previous);
    }

    public function getHttpStatus(): ?int
    {
        return $this->httpStatus;
    }

    public static function invalidPlayer(string $message = 'Invalid player'): self
    {
        return new self($message, self::INVALID_PLAYER, 400);
    }

    public static function alreadyInGame(string $message = 'Player already in game'): self
    {
        return new self($message, self::ALREADY_IN_GAME, 409);
    }

    public static function notFound(string $message = 'Player not found'): self
    {
        return new self($message, self::NOT_FOUND, 404);
    }

    public static function permissionDenied(string $message = 'Permission denied'): self
    {
        return new self($message, self::PERMISSION_DENIED, 403);
    }

    public static function validationError(string $message = 'Validation error'): self
    {
        return new self($message, self::VALIDATION_ERROR, 422);
    }

    public static function fromTrigger(string $message, int $level = E_USER_WARNING): self
    {
        switch ($level) {
            case E_USER_ERROR:
                return new self($message, self::INVALID_PLAYER, 500);
            case E_USER_WARNING:
                return new self($message, self::VALIDATION_ERROR, 400);
            case E_USER_NOTICE:
            default:
                return new self($message, self::INVALID_PLAYER, 400);
        }
    }
}
