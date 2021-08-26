<?php

namespace App\Modules\Example\Requests;

class DeleteExampleRequest extends \App\Modules\Core\Requests\DeleteFormRequest
{
    protected $table = 'examples';
}
