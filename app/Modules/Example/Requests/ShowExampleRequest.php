<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\ShowFormRequest;

class ShowExampleRequest extends ShowFormRequest
{
    protected $table = 'examples';
}
