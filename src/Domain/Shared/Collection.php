<?php
declare(strict_types=1);

namespace CodelyTV\FinderKata\Domain\Shared;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection implements Countable, IteratorAggregate
{
    private $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);
        $this->items = $items;
    }

    abstract protected function type(): string;

    public function getIterator()
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    protected function items(): array
    {
        return $this->items;
    }

    public function sortBy(callable $fn): array
    {
        $items = $this->items();
        usort($items, $fn);
        return $items;
    }
}