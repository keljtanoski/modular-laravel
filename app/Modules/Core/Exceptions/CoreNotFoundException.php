<?php

namespace App\Modules\Core\Exceptions;

abstract class CoreNotFoundException extends CoreException
{
    /**
     * @var int
     */
    public $code = 404;

    /**
     * @return string|null
     */
    public function message(): ?string
    {
        return "The requested resource was not found in the database";
    }
}
