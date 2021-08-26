<?php

namespace App\Modules\ExampleType\Requests;

class DeleteExampleTypeRequest extends \App\Modules\Core\Requests\DeleteFormRequest
{
    protected $table = 'example_types';
}
