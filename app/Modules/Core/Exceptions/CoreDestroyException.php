<?php

namespace App\Modules\Core\Exceptions;

abstract class CoreDestroyException extends CoreException
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
        return "Error while deleting resource";
    }
}
