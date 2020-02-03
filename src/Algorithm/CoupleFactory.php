<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

final class CoupleFactory
{
    public function __invoke(Person $personOne, Person $personTwo): Couple
    {
        if ($personOne->birthDate() < $personTwo->birthDate()) {
            return Couple::create($personOne, $personTwo);
        } else {
            return Couple::create($personTwo, $personOne);
        }
    }
}
