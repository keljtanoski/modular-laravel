<?php

namespace App\Modules\Core\Exceptions;

abstract class CoreStoreException extends CoreException
{
    /**
     * @var int
     */
    public $code = 422;

    /**
     * @return string|null
     */
    public function message(): ?string
    {
        return "Error while creating resource in the database";
    }
}
