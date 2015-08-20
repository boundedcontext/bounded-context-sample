<?php namespace BoundedContext\Collection;

class Collection implements \Iterator
{

    private $key;
    private $items;

    public function __construct(array $items = [])
    {

        $this->reset();

        foreach ($items as $item) {
            $this->append($item);
        }
    }

    public function count()
    {
        return count($this->items);
    }

    public function reset()
    {
        $this->items = [];
        $this->rewind();
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function is_empty()
    {
        return (count($this->items) == 0);
    }

    public function append(Collectable $c)
    {
        $this->items[] = $c;
    }

    public function append_collection(Collection $other)
    {
        foreach($other as $item)
        {
            $this->items[] = $item;
        }
    }

    public function current()
    {
        return $this->items[$this->key];
    }

    public function key()
    {
        return $this->key;
    }

    public function has_next()
    {
        return isset($this->items[$this->key]);
    }

    public function next()
    {
        $this->key = $this->key + 1;
    }

    public function valid()
    {
        return isset($this->items[$this->key]);
    }
}
