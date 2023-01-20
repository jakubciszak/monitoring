<?php

namespace App\Core\Common\Collection;

class CollectionAbstract implements \Iterator, \Countable
{
    private array $items = [];
    private int $key = 0;

    protected function _add(mixed $item)
    {
        $this->items[] = $item;
    }

    public function current(): mixed
    {
        return $this->items[$this->key];
    }

    public function next(): void
    {
        $this->key++;
    }

    public function key(): int
    {
        return $this->key;
    }

    public function valid(): bool
    {
        return array_key_exists($this->key(), $this->items);
    }

    public function rewind(): void
    {
        $this->key = 0;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
