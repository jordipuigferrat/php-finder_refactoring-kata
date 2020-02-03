<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

interface CoupleCriteria
{
    public function apply(Couple ...$couples): Couple;
}
