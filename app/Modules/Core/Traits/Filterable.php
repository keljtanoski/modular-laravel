<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Filters\FilterBuilder;
use Illuminate\Support\Str;
use ReflectionClass;

trait Filterable
{
    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilterBy($query, $filters): mixed
    {
        $namespace = $this->getNamespace();
        return (new FilterBuilder($query, $filters, $namespace))->apply();
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
