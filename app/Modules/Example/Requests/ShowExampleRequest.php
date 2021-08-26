<?php

namespace App\Modules\Example\Requests;

class ShowExampleRequest extends \App\Modules\Core\Requests\ShowFormRequest
{
    protected $table = 'examples';
}
