<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Persons;

use DateTime;

final class Person
{
    private $name;
    private $birthDate;

    private function __construct(PersonName $name, PersonBirthDate $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public static function create(PersonName $name, PersonBirthDate $birthDate): self
    {
        return new self($name, $birthDate);
    }

    public function name(): PersonName
    {
        return $this->name;
    }

    public function birthDate(): PersonBirthDate
    {
        return $this->birthDate;
    }

    public function isOlderThan(Person $person): bool
    {
        return $this->birthDate->laterThan($person->birthDate());
    }

    public function isYoungerThan(Person $person): bool
    {
        return $this->birthDate->earlierThan($person->birthDate());
    }
}
