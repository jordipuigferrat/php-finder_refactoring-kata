<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

final class Couple
{
    private $older;
    private $younger;
    private $differenceInSeconds;

    private function __construct(Person $older, Person $younger)
    {
        $this->older = $older;
        $this->younger = $younger;
        $this->differenceInSeconds = $younger->birthDate()->getTimestamp() - $older->birthDate()->getTimestamp();
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

    public function differenceInSeconds(): int
    {
        return $this->differenceInSeconds;
    }
}
