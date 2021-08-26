<?php

namespace App\Modules\Core\Abstracts;

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
