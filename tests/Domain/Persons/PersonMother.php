<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Domain\Persons;

use CodelyTV\FinderKata\Domain\Persons\Person;
use CodelyTV\FinderKata\Domain\Persons\PersonBirthDate;
use CodelyTV\FinderKata\Domain\Persons\PersonName;

final class PersonMother
{
    private static function create(PersonName $name, PersonBirthDate $birthDate): Person
    {
        return Person::create($name, $birthDate);
    }

    public static function with(string $name, string $birthDate): Person
    {
        return self::create(new PersonName($name), new PersonBirthDate($birthDate));
    }
}