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
use DateTime;
use PHPUnit\Framework\TestCase;

final class CoupleFinderTest extends TestCase
{
    private $sue;
    private $greg;
    private $sarah;
    private $mike;

    protected function setUp()
    {
        $this->sue = Person::create(new PersonName('Sue'), new PersonBirthDate('1950-01-01'));
        $this->greg = Person::create(new PersonName('Greg'), new PersonBirthDate('1952-05-01'));
        $this->sarah = Person::create(new PersonName('Sarah'), new PersonBirthDate('1982-01-01'));
        $this->mike = Person::create(new PersonName('Mike'), new PersonBirthDate('1979-01-01'));
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $this->expectException(NotEnoughPersonsException::class);

        $persons = [];
        $finder = new CoupleFinder(...$persons);

        $finder->find(new CoupleCriteriaClosest());
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $this->expectException(NotEnoughPersonsException::class);

        $persons = [];
        $persons[] = $this->sue;
        $finder = new CoupleFinder(...$persons);

        $finder->find(new CoupleCriteriaClosest());
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $persons = [];
        $persons[] = $this->sue;
        $persons[] = $this->greg;
        $finder = new CoupleFinder(...$persons);

        $couple = $finder->find(new CoupleCriteriaClosest());

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->greg, $couple->younger());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $persons = [];
        $persons[] = $this->mike;
        $persons[] = $this->greg;
        $finder = new CoupleFinder(...$persons);

        $couple = $finder->find(new CoupleCriteriaFurthest());

        $this->assertEquals($this->greg, $couple->older());
        $this->assertEquals($this->mike, $couple->younger());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $persons = [];
        $persons[] = $this->sue;
        $persons[] = $this->sarah;
        $persons[] = $this->mike;
        $persons[] = $this->greg;
        $finder = new CoupleFinder(...$persons);

        $couple = $finder->find(new CoupleCriteriaFurthest());

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->sarah, $couple->younger());
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $persons = [];
        $persons[] = $this->sue;
        $persons[] = $this->sarah;
        $persons[] = $this->mike;
        $persons[] = $this->greg;
        $finder = new CoupleFinder(...$persons);

        $couple = $finder->find(new CoupleCriteriaClosest());

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->greg, $couple->younger());
    }
}
