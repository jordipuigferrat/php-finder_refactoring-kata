<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples\Criteria;

use CodelyTV\FinderKata\Domain\Couples\Couple;

final class CoupleCriteriaFurthest implements CoupleCriteria
{
    public function apply(Couple ...$couples): Couple
    {
        usort($couples, $this->sortFurthestCouple());
        return $couples[0];
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
