<?php

namespace App\Modules\ExampleType\Requests;

use App\Modules\Core\Requests\ShowFormRequest;

class ShowExampleTypeRequest extends ShowFormRequest
{
    protected string $table = 'example_types';
}
