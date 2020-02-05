<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples;

use CodelyTV\FinderKata\Domain\Persons\Person;

final class Couple
{
    private $older;
    private $younger;
    private $differenceInSeconds;

    private function __construct(Person $older, Person $younger)
    {
        $this->older = $older;
        $this->younger = $younger;
        $this->differenceInSeconds = $this->calculateDifferenceInSeconds();
    }

    public static function create(Person $older, Person $younger): self
    {
        return new self($older, $younger);
    }

    public function older(): Person
    {
        return $this->older;
    }

    public function younger(): Person
    {
        return $this->younger;
    }

    public function differenceInSeconds(): CoupleDifferenceInSeconds
    {
        return $this->differenceInSeconds;
    }

    private function calculateDifferenceInSeconds(): CoupleDifferenceInSeconds
    {
        return new CoupleDifferenceInSeconds($this->younger()->birthDate()->calculateDifferenceInSeconds($this->older()->birthDate()));
    }
}
