<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples;

final class CoupleDifferenceInSeconds
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isEqualsTo(DifferenceInSeconds $differenceInSeconds): bool
    {
        return $this->value === $differenceInSeconds->value();
    }

    public function isHigherThan(DifferenceInSeconds $differenceInSeconds): bool
    {
        return $this->value > $differenceInSeconds->value();
    }

    public function isLowerThan(DifferenceInSeconds $differenceInSeconds): bool
    {
        return $this->value < $differenceInSeconds->value();
    }
}