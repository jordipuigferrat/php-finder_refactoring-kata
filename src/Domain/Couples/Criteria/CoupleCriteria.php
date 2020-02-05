<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Domain\Couples\Criteria;

use CodelyTV\FinderKata\Domain\Couples\Couple;

interface CoupleCriteria
{
    public function apply(Couple ...$couples): Couple;
}
