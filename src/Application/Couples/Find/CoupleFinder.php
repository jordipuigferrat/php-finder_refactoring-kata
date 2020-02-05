<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Application\Couples\Find;

use CodelyTV\FinderKata\Domain\Couples\Couple;
use CodelyTV\FinderKata\Domain\Couples\CoupleFactory;
use CodelyTV\FinderKata\Domain\Couples\Criteria\CoupleCriteria;
use CodelyTV\FinderKata\Domain\Couples\NotEnoughPersonsException;
use CodelyTV\FinderKata\Domain\Persons\Person;

final class CoupleFinder
{
    private $coupleFactory;

    public function __construct()
    {
        $this->coupleFactory = new CoupleFactory();
    }

    public function find(CoupleCriteria $criteria, Person ...$persons): Couple
    {
        $this->ensureMakeCouples(...$persons);
        $couples = $this->makeCouples(...$persons);
        return $criteria->apply(...$couples);
    }

    private function makeCouples(Person ...$persons): array
    {
        $couples = [];
        $numPersons = count($persons);

        for ($i = 0; $i < $numPersons; $i++) {
            for ($j = $i + 1; $j < $numPersons; $j++) {
                $couples[] = $this->coupleFactory->__invoke($persons[$i], $persons[$j]);
            }
        }
        return $couples;
    }

    private function ensureMakeCouples(Person ...$persons)
    {
        if(count($persons) <2){
            throw new NotEnoughPersonsException();
        }
    }
}
