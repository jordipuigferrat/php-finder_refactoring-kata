<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Domain\Couples\Criteria;

use CodelyTV\FinderKata\Domain\Couples\Couple;
use CodelyTV\FinderKata\Domain\Couples\Couples;

interface CoupleCriteria
{
    public function apply(Couples $couples): Couple;
}
