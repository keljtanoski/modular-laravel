<?php

namespace App\Modules\Example\Filters;

use App\Modules\Core\Abstracts\QueryFilter;
use App\Modules\Core\Interfaces\FilterInterface;

class ExampleType extends QueryFilter implements FilterInterface
{
    /**
     * @param $value
     * @return mixed|void
     */
    public function handle($value)
    {
        $this->query->whereHas('example_type', function ($q) use ($value) {
            return $q->where('name', $value);
        });
    }
}
