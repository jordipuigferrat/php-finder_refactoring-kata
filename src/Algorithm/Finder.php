<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    private $persons;
    private $coupleFactory;

    public function __construct(Person ...$persons)
    {
        $this->persons = $persons;
        $this->coupleFactory = new CoupleFactory();
    }

    public function find(int $ft): Couple
    {
        $couples = $this->doCouples();

        if ($this->hasNoCouples(...$couples)) {
            throw new NotEnoughPersonsException();
        }

        $coupleCriteriaApplied = $couples[0];
        foreach ($couples as $couple) {
            switch ($ft) {
                case Criteria::ONE:
                    if ($couple->differenceInSeconds() < $coupleCriteriaApplied->differenceInSeconds()) {
                        $coupleCriteriaApplied = $couple;
                    }
                    break;

                case Criteria::TWO:
                    if ($couple->differenceInSeconds() > $coupleCriteriaApplied->differenceInSeconds()) {
                        $coupleCriteriaApplied = $couple;
                    }
                    break;
            }
        }

        return $coupleCriteriaApplied;
    }

    private function doCouples(): array
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
