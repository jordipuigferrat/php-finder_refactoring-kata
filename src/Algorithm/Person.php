<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTime;

final class Person
{
    private $name;
    private $birthDate;

    private function __construct(string $name, DateTime $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public static function create(string $name, DateTime $birthDate): self
    {
        return new self($name, $birthDate);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function birthDate(): DateTime
    {
        return $this->birthDate;
    }
}
