<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Domain\Persons;

use CodelyTV\FinderKata\Domain\Persons\Person;
use CodelyTV\FinderKata\Domain\Persons\PersonBirthDate;
use CodelyTV\FinderKata\Domain\Persons\PersonName;
use CodelyTV\FinderKata\Domain\Persons\Persons;

final class PersonsMother
{
    public static function empty(): Persons
    {
        return new Persons([]);
    }

    private static function create(Person ...$persons): Persons
    {
        return new Persons($persons);
    }

    public static function with(Person ...$persons): Persons
    {
        return self::create(...$persons);
    }
}