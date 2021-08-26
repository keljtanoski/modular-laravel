<?php

namespace App\Modules\ExampleType\Requests;

class ShowExampleTypeRequest extends \App\Modules\Core\Requests\ShowFormRequest
{
    protected $table = 'example_types';
}
