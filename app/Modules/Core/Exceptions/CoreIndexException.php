<?php

namespace App\Modules\Core\Exceptions;

abstract class CoreIndexException extends CoreException
{
    /**
     * @var int
     */
    public $code = 500;

    /**
     * @return string|null
     */
    public function message(): ?string
    {
        return "Something went wrong while getting data from database";
    }
}
