<?php

namespace App\Modules\Core\Interfaces;

interface SearchInterface
{
    /**
     * @param array $request
     * @return mixed
     */
    public function search(array $request);
}
