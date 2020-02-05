<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples;

use CodelyTV\FinderKata\Domain\Persons\Person;

final class CoupleFactory
{
    public function __invoke(Person $personOne, Person $personTwo): Couple
    {
        if ($personOne->isOlderThan($personTwo)) {
            return Couple::create($personOne, $personTwo);
        } else {
            return Couple::create($personTwo, $personOne);
        }
    }
}
