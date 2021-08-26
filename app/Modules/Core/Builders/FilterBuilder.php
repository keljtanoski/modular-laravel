<?php

namespace App\Modules\Core\Builders;

use Illuminate\Support\Str;

class FilterBuilder
{
    /**
     * @var
     */
    protected $query;

    /**
     * @var
     */
    protected $filters;

    /**
     * @var
     */
    protected $namespace;

    /**
     * @param $query
     * @param $filters
     * @param $namespace
     */
    public function __construct($query, $filters, $namespace)
    {
        $this->query = $query;
        $this->filters = $filters;
        $this->namespace = $namespace;
    }

    /**
     * @return mixed
     */
    public function apply()
    {
        foreach ($this->filters as $name => $value) {
            $normalizedName = Str::ucfirst(Str::camel($name));
            $class = $this->namespace . "\\Filters\\{$normalizedName}";

            if (!class_exists($class)) {
                continue;
            }

            if (Str::length($value)) {
                (new $class($this->query))->handle($value);
            } else {
                (new $class($this->query))->handle();
            }
        }

        return $this->query;
    }
}
