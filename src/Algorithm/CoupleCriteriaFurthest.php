<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

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
            if ($coupleOne->differenceInSeconds() === $coupleTwo->differenceInSeconds()) {
                return 0;
            }
            return $coupleOne->differenceInSeconds() > $coupleTwo->differenceInSeconds() ? -1 : 1;
        };
    }
}
