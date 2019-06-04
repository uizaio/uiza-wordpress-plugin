<?php

namespace Uiza\Util;

class Collection
{
    /**
     * The items contained in the collection.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Create a new collection.
     *
     * @param  mixed  $items
     * @return void
     */

    public function __construct($items = [])
    {
        $this->items = is_array($items) ? $items : $this->getArrayableItems($items);
    }

    public function add($obj, $key = null)
    {
        if ($key == null) {
            $this->items[] = $obj;
        }
    }

    public function delete($key)
    {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        } else {
            throw new \Uiza\Exception\Base("Invalid key $key.");
        }
    }

    public function get($key)
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            throw new \Uiza\Exception\Base("Invalid key $key.");
        }
    }

    /**
     * Run a filter over each of the items.
     *
     * @param  callable|null  $callback
     * @return static
     */
    public function filter(callable $callback = null)
    {
        if ($callback) {
            return new static(arr_where($this->items, $callback));
        }

        return new static(array_filter($this->items));
    }

    public function keys()
    {
        return array_keys($this->items);
    }

    public function length()
    {
        return count($this->items);
    }

    public function keyExists($key)
    {
        return isset($this->items[$key]);
    }

    /**
     * Results array of items from Collection or Arrayable.
     *
     * @param  mixed  $items
     * @return array
     */
    protected function getArrayableItems($items)
    {
        if ($items instanceof self) {
            return $items->all();
        } elseif ($items instanceof Arrayable) {
            return $items->toArray();
        } elseif ($items instanceof Jsonable) {
            return json_decode($items->toJson(), true);
        }
        return (array) $items;
    }

    /**
     * Get all of the items in the collection.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Execute a callback over each item.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function each(callable $callback)
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }
}
