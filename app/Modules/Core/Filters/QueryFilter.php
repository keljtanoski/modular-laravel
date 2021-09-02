<?php

namespace App\Modules\Core\Filters;

abstract class QueryFilter
{
    /**
     * @var
     */
    protected $query;

    /**
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }
}
