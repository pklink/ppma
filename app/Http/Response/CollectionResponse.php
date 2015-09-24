<?php

namespace App\Http\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;

class CollectionResponse implements Arrayable
{

    /**
     * @var Collection
     */
    public $collection;

    /**
     * CollectionResponse constructor.
     * @param Collection $list
     */
    public function __construct(Collection $list)
    {
        $this->collection = $list;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return ['data' => $this->getCollection()->toArray()];
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

}