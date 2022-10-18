<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\DeleteFormRequest;

class DeleteExampleRequest extends DeleteFormRequest
{
    /**
     * @var string
     */
    protected string $table = 'examples';
}
