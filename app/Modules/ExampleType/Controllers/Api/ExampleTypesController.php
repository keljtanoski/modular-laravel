<?php

namespace App\Modules\ExampleType\Controllers\Api;

use App\Modules\Core\Controllers\ApiController;
use App\Modules\Core\Helpers\Helper;
use App\Modules\ExampleType\Exceptions\ExampleTypeDestroyException;
use App\Modules\ExampleType\Exceptions\ExampleTypeIndexException;
use App\Modules\ExampleType\Exceptions\ExampleTypeNotFoundException;
use App\Modules\ExampleType\Exceptions\ExampleTypeStoreException;
use App\Modules\ExampleType\Exceptions\ExampleTypeUpdateException;
use App\Modules\ExampleType\Requests\CreateExampleTypeRequest;
use App\Modules\ExampleType\Requests\DeleteExampleTypeRequest;
use App\Modules\ExampleType\Requests\SearchExampleTypeRequest;
use App\Modules\ExampleType\Requests\ShowExampleTypeRequest;
use App\Modules\ExampleType\Requests\UpdateExampleTypeRequest;
use App\Modules\ExampleType\Services\ExampleTypeService;
use App\Modules\ExampleType\Transformers\ExampleTypeResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExampleTypesController extends ApiController
{
    /**
     * @var ExampleTypeService
     */
    protected $exampleTypeService;

    /**
     * @param ExampleTypeService $exampleTypeService
     */
    public function __construct(ExampleTypeService $exampleTypeService)
    {
        $this->exampleTypeService = $exampleTypeService;
    }

    /**
     * @param SearchExampleTypeRequest $request
     * @return AnonymousResourceCollection
     * @throws ExampleTypeIndexException
     */
    public function index(SearchExampleTypeRequest $request)
    {
        try {
            return ExampleTypeResource::collection($this->exampleTypeService->search($request->validated()));
        } catch (Exception $exception) {
            throw new ExampleTypeIndexException($exception);
        }
    }

    /**
     * @param ShowExampleTypeRequest $request
     * @return JsonResponse
     * @throws ExampleTypeNotFoundException
     */
    public function show(ShowExampleTypeRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.ok',
                    ['resource' => Helper::getResourceName(
                        $this->exampleTypeService->exampleTypeRepository->model)
                    ]))
                ->respond(new ExampleTypeResource($this->exampleTypeService->getById($request->id)));
        } catch (Exception $exception) {
            throw new ExampleTypeNotFoundException($exception);
        }
    }

    /**
     * @param CreateExampleTypeRequest $request
     * @return JsonResponse
     * @throws ExampleTypeStoreException
     */
    public function store(CreateExampleTypeRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.storeSuccess',
                    ['resource' => Helper::getResourceName(
                        $this->exampleTypeService->exampleTypeRepository->model)
                    ]))
                ->respond(new ExampleTypeResource($this->exampleTypeService->create($request->validated())));
        } catch (Exception $exception) {
            throw new ExampleTypeStoreException($exception);
        }
    }

    /**
     * @param UpdateExampleTypeRequest $request
     * @return JsonResponse
     * @throws ExampleTypeUpdateException
     */
    public function update(UpdateExampleTypeRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.updateSuccess',
                    ['resource' => Helper::getResourceName(
                        $this->exampleTypeService->exampleTypeRepository->model)
                    ]))
                ->respond(new ExampleTypeResource($this->exampleTypeService
                    ->update($request->validated())
                ));
        } catch (Exception $exception) {
            throw new ExampleTypeUpdateException($exception);
        }
    }

    /**
     * @param DeleteExampleTypeRequest $request
     * @return JsonResponse
     * @throws ExampleTypeDestroyException
     */
    public function destroy(DeleteExampleTypeRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.deleteSuccess',
                    ['resource' => Helper::getResourceName(
                        $this->exampleTypeService->exampleTypeRepository->model)
                    ]))
                ->respond($this->exampleTypeService->delete($request->id));
        } catch (Exception $exception) {
            throw new ExampleTypeDestroyException($exception);
        }
    }
}
