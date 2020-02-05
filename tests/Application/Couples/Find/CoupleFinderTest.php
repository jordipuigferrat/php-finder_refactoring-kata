<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Application\Couples\Find\CoupleFinder;
use CodelyTV\FinderKata\Domain\Couples\Criteria\CoupleCriteriaClosest;
use CodelyTV\FinderKata\Domain\Couples\Criteria\CoupleCriteriaFurthest;
use CodelyTV\FinderKata\Domain\Couples\NotEnoughPersonsException;
use CodelyTV\FinderKata\Domain\Persons\Person;
use CodelyTV\FinderKata\Domain\Persons\PersonBirthDate;
use CodelyTV\FinderKata\Domain\Persons\PersonName;
use CodelyTV\FinderKataTest\Domain\Persons\PersonMother;
use DateTime;
use PHPUnit\Framework\TestCase;

final class CoupleFinderTest extends TestCase
{
    private $finder;

    private $sue;
    private $greg;
    private $sarah;
    private $mike;

    protected function setUp()
    {
        $this->finder = new CoupleFinder();

        $this->sue = PersonMother::with('Sue', '1950-01-01');
        $this->greg = PersonMother::with('Greg', '1952-05-01');
        $this->sarah = PersonMother::with('Sarah', '1982-01-01');
        $this->mike = PersonMother::with('Mike', '1979-01-01');
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $this->expectException(NotEnoughPersonsException::class);

        $persons = [];

        $this->finder->find(new CoupleCriteriaClosest(), ...$persons);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $this->expectException(NotEnoughPersonsException::class);

        $persons = [$this->sue];

        $this->finder->find(new CoupleCriteriaClosest(), ...$persons);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $persons = [$this->sue, $this->greg];

        $couple = $this->finder->find(new CoupleCriteriaClosest(), ...$persons);

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->greg, $couple->younger());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $persons = [$this->mike, $this->greg];

        $couple = $this->finder->find(new CoupleCriteriaFurthest(), ...$persons);

        $this->assertEquals($this->greg, $couple->older());
        $this->assertEquals($this->mike, $couple->younger());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $persons = [$this->sue, $this->sarah,$this->mike,$this->greg];

        $couple = $this->finder->find(new CoupleCriteriaFurthest(), ...$persons);

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->sarah, $couple->younger());
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $persons = [$this->sue, $this->sarah,$this->mike,$this->greg];

        $couple = $this->finder->find(new CoupleCriteriaClosest(), ...$persons);

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->greg, $couple->younger());
    }
}
