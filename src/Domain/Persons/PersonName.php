<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Persons;

final class PersonName
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}