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

    public function find(int $ft): Couple
    {
        $couples = [];

        for ($i = 0; $i < count($this->persons); $i++) {
            for ($j = $i + 1; $j < count($this->persons); $j++) {
                $r = new Couple();

                if ($this->persons[$i]->birthDate() < $this->persons[$j]->birthDate()) {
                    $r->p1 = $this->persons[$i];
                    $r->p2 = $this->persons[$j];
                } else {
                    $r->p1 = $this->persons[$j];
                    $r->p2 = $this->persons[$i];
                }

                $r->d = $r->p2->birthDate()->getTimestamp()
                    - $r->p1->birthDate()->getTimestamp();

                $couples[] = $r;
            }
        }

        if (count($couples) < 1) {
            return new Couple();
        }

        $answer = $couples[0];

        foreach ($couples as $result) {
            switch ($ft) {
                case Criteria::ONE:
                    if ($result->d < $answer->d) {
                        $answer = $result;
                    }
                    break;

                case Criteria::TWO:
                    if ($result->d > $answer->d) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
