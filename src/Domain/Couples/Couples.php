<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples;

use CodelyTV\FinderKata\Domain\Shared\Collection;

final class Couples extends Collection
{
    protected function type(): string
    {
        return Couple::class;
    }

    public function all(): array
    {
        return $this->items();
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}