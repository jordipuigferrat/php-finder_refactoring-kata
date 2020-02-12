<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Application\Couples\Find;

use CodelyTV\FinderKata\Application\Couples\Make\CoupleMaker;
use CodelyTV\FinderKata\Domain\Couples\Couple;
use CodelyTV\FinderKata\Domain\Couples\Criteria\CoupleCriteria;
use CodelyTV\FinderKata\Domain\Couples\NotEnoughPersonsException;
use CodelyTV\FinderKata\Domain\Persons\Person;

final class CoupleFinder
{
    private $coupleMaker;

    public function __construct()
    {
        $this->coupleMaker = new CoupleMaker();
    }

    public function find(CoupleCriteria $criteria, Person ...$persons): Couple
    {
        $this->ensureCanMakeCouples(...$persons);

        $couples = $this->coupleMaker->__invoke(...$persons);

        return $criteria->apply(...$couples);
    }

    private function ensureCanMakeCouples(Person ...$persons)
    {
        if (count($persons) < 2) {
            throw new NotEnoughPersonsException();
        }
    }
}
