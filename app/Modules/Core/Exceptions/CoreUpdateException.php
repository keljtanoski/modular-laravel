<?php

namespace App\Modules\Core\Exceptions;

abstract class CoreUpdateException extends CoreException
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
        return "Error while updating resource in the database";
    }
}
