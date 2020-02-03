<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\CoupleCriteriaClosest;
use CodelyTV\FinderKata\Algorithm\CoupleCriteriaFurthest;
use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\CoupleCriteria;
use CodelyTV\FinderKata\Algorithm\NotEnoughPersonsException;
use CodelyTV\FinderKata\Algorithm\Person;
use DateTime;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    private $sue;
    private $greg;
    private $sarah;
    private $mike;

    protected function setUp()
    {
        $this->sue = Person::create('Sue', new DateTime('1950-01-01'));
        $this->greg = Person::create('Greg', new DateTime('1952-05-01'));
        $this->sarah = Person::create('Sarah', new DateTime('1982-01-01'));
        $this->mike = Person::create('Mike', new DateTime('1979-01-01'));
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $this->expectException(NotEnoughPersonsException::class);

        $persons = [];
        $finder = new Finder(...$persons);

        $finder->find(new CoupleCriteriaClosest());
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $this->expectException(NotEnoughPersonsException::class);

        $persons = [];
        $persons[] = $this->sue;
        $finder = new Finder(...$persons);

        $finder->find(new CoupleCriteriaClosest());
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $persons = [];
        $persons[] = $this->sue;
        $persons[] = $this->greg;
        $finder = new Finder(...$persons);

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
        $finder = new Finder(...$persons);

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
        $finder = new Finder(...$persons);

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
        $finder = new Finder(...$persons);

        $couple = $finder->find(new CoupleCriteriaClosest());

        $this->assertEquals($this->sue, $couple->older());
        $this->assertEquals($this->greg, $couple->younger());
    }
}
