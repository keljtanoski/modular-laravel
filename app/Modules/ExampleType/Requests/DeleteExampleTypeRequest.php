<?php

namespace App\Modules\ExampleType\Requests;

use App\Modules\Core\Requests\DeleteFormRequest;

class DeleteExampleTypeRequest extends DeleteFormRequest
{
    protected $table = 'example_types';
}
