<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\DeleteFormRequest;

class DeleteExampleRequest extends DeleteFormRequest
{
    protected $table = 'examples';
}
