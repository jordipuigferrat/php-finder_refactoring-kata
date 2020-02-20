<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples;

use InvalidArgumentException;

final class CouplesNotFoundException extends InvalidArgumentException
{
    protected $message = 'No couples found';
}