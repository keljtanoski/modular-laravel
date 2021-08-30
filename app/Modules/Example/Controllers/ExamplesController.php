<?php

namespace App\Modules\Example\Controllers;

use App\Modules\Core\Controllers\Controller;
use App\Modules\Example\Services\ExampleService;

class ExamplesController extends Controller
{
    protected $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function create()
    {
        return view("Example::create");
    }
}
