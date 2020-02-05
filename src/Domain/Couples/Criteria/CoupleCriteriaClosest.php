<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Couples\Criteria;

use CodelyTV\FinderKata\Domain\Couples\Couple;

final class CoupleCriteriaClosest implements CoupleCriteria
{
    public function apply(Couple ...$couples): Couple
    {
        usort($couples, $this->sortClosestCouple());
        return $couples[0];
    }

    private function sortClosestCouple(): callable
    {
        return static function (Couple $coupleOne, Couple $coupleTwo): int {
            if ($coupleOne->differenceInSeconds() === $coupleTwo->differenceInSeconds()) {
                return 0;
            }
            return $coupleOne->differenceInSeconds() < $coupleTwo->differenceInSeconds() ? -1 : 1;
        };
    }
}
