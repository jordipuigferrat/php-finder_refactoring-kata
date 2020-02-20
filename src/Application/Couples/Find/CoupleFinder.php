<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Application\Couples\Find;

use CodelyTV\FinderKata\Application\Couples\Make\CoupleMaker;
use CodelyTV\FinderKata\Domain\Couples\Couple;
use CodelyTV\FinderKata\Domain\Couples\Couples;
use CodelyTV\FinderKata\Domain\Couples\Criteria\CoupleCriteria;
use CodelyTV\FinderKata\Domain\Couples\CouplesNotFoundException;
use CodelyTV\FinderKata\Domain\Persons\Persons;

final class CoupleFinder
{
    private $coupleMaker;

    public function __construct()
    {
        $this->coupleMaker = new CoupleMaker();
    }

    public function find(CoupleCriteria $criteria, Persons $persons): Couple
    {
        $couples = $this->coupleMaker->__invoke($persons);

        $this->ensureHasCouples($couples);

        return $criteria->apply($couples);
    }

    private function ensureHasCouples(Couples $couples)
    {
        if ($couples->isEmpty()) {
            throw new CouplesNotFoundException();
        }
    }
}
