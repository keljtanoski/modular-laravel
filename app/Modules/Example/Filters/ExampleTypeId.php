<?php

namespace App\Modules\Example\Filters;

use App\Modules\Core\Abstracts\QueryFilter;
use App\Modules\Core\Interfaces\FilterInterface;

class ExampleTypeId extends QueryFilter implements FilterInterface
{
    /**
     * @param $value
     * @return mixed|void
     */
    public function handle($value)
    {
        $this->query->where('example_type_id', '=', $value);
    }
}
