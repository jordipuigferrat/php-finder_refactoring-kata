<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Persons;

use DateTime;
use InvalidArgumentException;

final class PersonBirthDate
{
    CONST FORMAT_DATE = 'Y-m-d';

    private $value;

    public function __construct(string $value)
    {
        $this->ensureIsValidDate($value);

        $this->value = new DateTime($value);
    }

    public function value(): DateTime
    {
        return $this->value;
    }

    public function laterThan(PersonBirthDate $personBirthDate): bool
    {
        return $this->value < $personBirthDate->value();
    }

    public function earlierThan(PersonBirthDate $personBirthDate): bool
    {
        return $this->value > $personBirthDate->value();
    }

    public function calculateDifferenceInSeconds(PersonBirthDate $personBirthDate): int
    {
        return $this->value->getTimestamp() - $personBirthDate->value()->getTimestamp();
    }

    private function ensureIsValidDate(string $value)
    {
        $date = DateTime::createFromFormat(self::FORMAT_DATE, $value);

        if (!$date || $date->format(self::FORMAT_DATE) !== $value) {
            throw new InvalidArgumentException(sprintf('The birthdate <%s> is not valid', $value));
        }
    }

}