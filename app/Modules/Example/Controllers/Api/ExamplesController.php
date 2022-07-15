<?php

namespace App\Modules\Example\Controllers\Api;

use App\Modules\Core\Controllers\ApiController;
use App\Modules\Core\Helpers\Helper;
use App\Modules\Example\Exceptions\ExampleDestroyException;
use App\Modules\Example\Exceptions\ExampleIndexException;
use App\Modules\Example\Exceptions\ExampleNotFoundException;
use App\Modules\Example\Exceptions\ExampleStoreException;
use App\Modules\Example\Exceptions\ExampleUpdateException;
use App\Modules\Example\Requests\CreateExampleRequest;
use App\Modules\Example\Requests\DeleteExampleRequest;
use App\Modules\Example\Requests\SearchExampleRequest;
use App\Modules\Example\Requests\ShowExampleRequest;
use App\Modules\Example\Requests\UpdateExampleRequest;
use App\Modules\Example\Services\ExampleService;
use App\Modules\Example\Transformers\ExampleResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExamplesController extends ApiController
{
    /**
     * @var ExampleService
     */
    private ExampleService $exampleService;

    /**
     * @param ExampleService $exampleService
     */
    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    /**
     * @param SearchExampleRequest $request
     * @return AnonymousResourceCollection
     * @throws ExampleIndexException
     */
    public function index(SearchExampleRequest $request)
    {
        try {
            return ExampleResource::collection($this->exampleService->search($request->validated()));
        } catch (Exception $exception) {
            throw new ExampleIndexException($exception);
        }
    }

    /**
     * @param ShowExampleRequest $request
     * @return JsonResponse
     * @throws ExampleNotFoundException
     */
    public function show(ShowExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(
                    __(
                        'apiResponse.ok',
                        [
                            'resource' => Helper::getResourceName(
                                $this->exampleService->exampleRepository->model
                            )
                        ]
                    )
                )
                ->respond(new ExampleResource($this->exampleService->getById($request->id)));
        } catch (Exception $exception) {
            throw new ExampleNotFoundException($exception);
        }
    }

    /**
     * @param CreateExampleRequest $request
     * @return JsonResponse
     * @throws ExampleStoreException
     */
    public function store(CreateExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(
                    __(
                        'apiResponse.storeSuccess',
                        [
                            'resource' => Helper::getResourceName(
                                $this->exampleService->exampleRepository->model
                            )
                        ]
                    )
                )
                ->respond(new ExampleResource($this->exampleService->create($request->validated())));
        } catch (Exception $exception) {
            throw new ExampleStoreException($exception);
        }
    }

    /**
     * @param UpdateExampleRequest $request
     * @return JsonResponse
     * @throws ExampleUpdateException
     */
    public function update(UpdateExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(
                    __(
                        'apiResponse.updateSuccess',
                        [
                            'resource' => Helper::getResourceName(
                                $this->exampleService->exampleRepository->model
                            )
                        ]
                    )
                )
                ->respond(
                    new ExampleResource(
                        $this->exampleService
                            ->update($request->validated())
                    )
                );
        } catch (Exception $exception) {
            throw new ExampleUpdateException($exception);
        }
    }

    /**
     * @param DeleteExampleRequest $request
     * @return JsonResponse
     * @throws ExampleDestroyException
     */
    public function destroy(DeleteExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(
                    __(
                        'apiResponse.deleteSuccess',
                        [
                            'resource' => Helper::getResourceName(
                                $this->exampleService->exampleRepository->model
                            )
                        ]
                    )
                )
                ->respond($this->exampleService->delete($request->id));
        } catch (Exception $exception) {
            throw new ExampleDestroyException($exception);
        }
    }
}
