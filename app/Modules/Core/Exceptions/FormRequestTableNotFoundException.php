<?php

namespace App\Modules\Core\Exceptions;

class FormRequestTableNotFoundException extends CoreException
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
        return "Table not found in the form request";
    }
}
