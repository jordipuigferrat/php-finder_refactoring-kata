<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

use InvalidArgumentException;

final class NotEnoughPersonsException extends InvalidArgumentException
{
    protected $message = 'Not enough persons to do couples';
}