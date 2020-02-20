<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Persons;

use CodelyTV\FinderKata\Domain\Shared\Collection;

final class Persons extends Collection
{
    protected function type(): string
    {
        return Person::class;
    }

    public function all(): array
    {
        return $this->items();
    }
}