<?php

namespace App\Modules\ExampleType\Requests;

use App\Modules\Core\Requests\DeleteFormRequest;

class DeleteExampleTypeRequest extends DeleteFormRequest
{
    protected string $table = 'example_types';
}
