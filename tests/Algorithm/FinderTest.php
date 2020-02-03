<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\Criteria;
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
        $list = [];
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::TWO);

        $this->assertEquals($this->greg, $result->p1);
        $this->assertEquals($this->mike, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::TWO);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->sarah, $result->p2);
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }
}
