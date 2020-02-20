<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples\Criteria;

use CodelyTV\FinderKata\Domain\Couples\Couple;
use CodelyTV\FinderKata\Domain\Couples\Couples;

final class CoupleCriteriaFurthest implements CoupleCriteria
{
    public function apply(Couples $couples): Couple
    {
        $sortedCouples = $couples->sortBy($this->sortFurthestCouple());
        return $sortedCouples[0];
    }

    private function sortFurthestCouple(): callable
    {
        return static function (Couple $coupleOne, Couple $coupleTwo): int {
            if ($coupleOne->differenceInSeconds()->isEqualsTo($coupleTwo->differenceInSeconds())) {
                return 0;
            }
            return $coupleOne->differenceInSeconds()->isHigherThan($coupleTwo->differenceInSeconds()) ? -1 : 1;
        };
    }
}
