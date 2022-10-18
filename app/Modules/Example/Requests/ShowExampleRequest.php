<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\ShowFormRequest;

class ShowExampleRequest extends ShowFormRequest
{
    /**
     * @var string
     */
    protected string $table = 'examples';
}
