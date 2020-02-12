<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Application\Couples\Make;

use CodelyTV\FinderKata\Domain\Couples\CoupleFactory;
use CodelyTV\FinderKata\Domain\Persons\Person;

final class CoupleMaker
{
    public function __invoke(Person ...$persons): array
    {
        $couples = [];
        $numPersons = count($persons);

        for ($i = 0; $i < $numPersons; $i++) {
            for ($j = $i + 1; $j < $numPersons; $j++) {
                $couples[] = CoupleFactory::create($persons[$i], $persons[$j]);
            }
        }
        return $couples;
    }
}