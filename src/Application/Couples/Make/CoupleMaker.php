<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Application\Couples\Make;

use CodelyTV\FinderKata\Domain\Couples\CoupleFactory;
use CodelyTV\FinderKata\Domain\Couples\Couples;
use CodelyTV\FinderKata\Domain\Persons\Persons;

final class CoupleMaker
{
    public function __invoke(Persons $persons): Couples
    {
        $couples = [];
        $allPersons = $persons->all();
        $numPersons = $persons->count();

        for ($i = 0; $i < $numPersons; $i++) {
            for ($j = $i + 1; $j < $numPersons; $j++) {
                $couples[] = CoupleFactory::create($allPersons[$i], $allPersons[$j]);
            }
        }
        return new Couples($couples);
    }
}