<?php

namespace App\Modules\Example\Controllers;

use App\Modules\Core\Controllers\Controller;
use App\Modules\Example\Services\ExampleService;
use Illuminate\Contracts\Support\Renderable;

class ExamplesController extends Controller
{
    /**
     * @var ExampleService
     */
    protected $exampleService;

    /**
     * @param ExampleService $exampleService
     */
    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('Example::index');
    }

    public function create()
    {
        return view("Example::create");
    }
}
