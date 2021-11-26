<?php

namespace App\Modules\ExampleType\Controllers;

use App\Modules\Core\Controllers\Controller;
use App\Modules\ExampleType\Services\ExampleTypeService;

class ExampleTypesController extends Controller
{
    /**
     * @var ExampleTypeService
     */
    private $exampleTypeService;

    /**
     * @param ExampleTypeService $exampleTypeService
     */
    public function __construct(ExampleTypeService $exampleTypeService)
    {
        $this->exampleTypeService = $exampleTypeService;
    }
}
