<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Builders\FilterBuilder;
use Illuminate\Support\Str;
use ReflectionClass;

trait Filterable
{
    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilterBy($query, $filters)
    {
        $namespace = $this->getNamespace();
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }

    /**
     * @return string
     */
    private function getNamespace(): string
    {
        $reflection = new ReflectionClass(self::class);
        return Str::replace('\Models', '', $reflection->getNamespaceName());
    }
}
