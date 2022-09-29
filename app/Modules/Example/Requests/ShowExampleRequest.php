<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\ShowFormRequest;

class ShowExampleRequest extends ShowFormRequest
{
    protected string $table = 'examples';
}
