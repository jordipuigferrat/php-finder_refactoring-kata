<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    private $persons;

    public function __construct(array $persons)
    {
        $this->persons = $persons;
    }

    public function find(int $ft): ?Couple
    {
        $couples = [];

        for ($i = 0; $i < count($this->persons); $i++) {
            for ($j = $i + 1; $j < count($this->persons); $j++) {
                if ($this->persons[$i]->birthDate() < $this->persons[$j]->birthDate()) {
                    $couple = Couple::create($this->persons[$i],$this->persons[$j]);
                } else {
                    $couple = Couple::create($this->persons[$j],$this->persons[$i]);

                }
                $couples[] = $couple;
            }
        }

        if (count($couples) < 1) {
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
}
