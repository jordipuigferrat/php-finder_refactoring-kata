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
    private $persons;
    private $coupleFactory;

    public function __construct(Person ...$persons)
    {
        $this->persons = $persons;
        $this->coupleFactory = new CoupleFactory();
    }

    public function find(CoupleCriteria $criteria): Couple
    {
        $couples = $this->makeCouples();

        if ($this->hasNoCouples(...$couples)) {
            throw new NotEnoughPersonsException();
        }

        return $criteria->apply(...$couples);
    }

    private function makeCouples(): array
    {
        $couples = [];
        $numPersons = count($this->persons);

        for ($i = 0; $i < $numPersons; $i++) {
            for ($j = $i + 1; $j < $numPersons; $j++) {
                $couples[] = $this->coupleFactory->__invoke($this->persons[$i], $this->persons[$j]);
            }
        }
        return $couples;
    }

    private function hasNoCouples(Couple ...$couples): bool
    {
        return count($couples) === 0;
    }
}
