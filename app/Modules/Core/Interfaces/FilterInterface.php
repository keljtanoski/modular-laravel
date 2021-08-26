<?php

namespace App\Modules\Core\Interfaces;

interface FilterInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value);
}
