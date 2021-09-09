## Introduction

The following Laravel project/directory structure represents a personal boilerplate modular/SOA structure that I use most of the time when starting a new Laravel project.

I found myself creating the same structure multiple times during the past couple of months so I decided to create a boilerplate project starter.

## Core structure
The Core module contains the main interfaces, abstract classes and implementations

### Directory overview

```
app
├── Modules
│   └── Core
│       ├── Controllers
│       |   ├── ApiController.php
|       |   └── Controller.php
│       ├── Exceptions
│       |   ├── FormRequestTableNotFoundException.php
│       |   ├── GeneralException.php
│       |   ├── GeneralIndexException.php
│       |   ├── GeneralSearchException.php
│       |   ├── GeneralStoreException.php
│       |   ├── GeneralNotFoundException.php
│       |   ├── GeneralDestroyException.php
|       |   └── GeneralUpdateException.php
│       ├── Filters
│       |   ├── QueryFilter.php
|       |   └── FilterBuilder.php
│       ├── Helpers
|       |   └── Helper.php
│       ├── Interfaces
│       |   ├── FilterInterface.php
│       |   ├── SearchInterface.php
|       |   └── RepositoryInterface.php
│       ├── Models
|       |   └── .gitkeep
│       ├── Repositories
|       |   └── Repository.php
│       ├── Requests
│       |   ├── FormRequest.php
│       |   ├── CreateFormRequest.php
│       |   ├── DeleteFormRequest.php
│       |   ├── SearchFormRequest.php
│       |   ├── UpdateFormRequest.php
|       |   └── ShowFormRequest.php
│       ├── Resources
│       |   └── .gitkeep 
│       ├── Scopes
|       |   └── .gitkeep
│       ├── Traits
│       |   ├── ApiResponses.php
|       |   └── Filterable.php
│       ├── Transformers
│       |   ├── EmptyResource.php
|       |   └── EmptyResourceCollection.php
│       └── 
└── 
```
### Interfaces
The main interface is the **RepositoryInterface** which has the basic CRUD and some additional methods defined.

```php

namespace App\Modules\Core\Interfaces;

interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param string $column
     * @param $value
     * @return mixed
     */
    public function findBy(string $column, $value);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);


    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

}
```

The **Repository** class that implements the **RepositoryInterface** looks like this:

```php

namespace App\Modules\Core\Repositories;

use App\Modules\Core\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    /**
     * Model::class
     */
    public $model;

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->model::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model::find($id);
    }

    /**
     * @param string $column
     * @param $value
     * @return mixed
     */
    public function findBy(string $column, $value)
    {
        return $this->model::where($column, $value);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model::create($data)->fresh();
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $item = $this->findById($id);
        $item->fill($data);
        $item->save();
        return $item->fresh();
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function delete(int $id)
    {
        $this->model::destroy($id);
    }
}
```

The other two interfaces are **SearchInterface** and **FilterInterface**

The **SearchInterface** defines one method, this interface can be implemented by a specific Repository class per Module when there is a need for a Search filter while retrieving data from the database.

```php

namespace App\Modules\Core\Interfaces;

interface SearchInterface
{
    /**
     * @param array $request
     * @return mixed
     */
    public function search(array $request);
}
```
Example implementation of the **SearchInterface**

```php
namespace App\Modules\Example\Repositories;

class ExampleRepository extends Repository implements ExampleInterface, SearchInterface
{
    /**
     * @var string
     */
    public $model = Example::class;

    /**
     * @param array $request
     * @return mixed
     * @throws ExampleSearchException
     */
    public function search(array $request)
    {
        try {
            $query = $this->model::filterBy($request);

            $query->orderBy(Arr::get($request, 'order_by') ?? 'id', Arr::get($request, 'sort') ?? 'desc');

            return $query->paginate(Arr::get($request, 'per_page') ?? (new $this->model)->getPerPage());

        } catch (Exception $exception) {
            throw new ExampleSearchException($exception);
        }
    }
}
```
This can be further abstracted, but I will handle that in some future release :smile:

Also, the **FilterInterface** defines only one method and this interface is implemented per Filter class per module if there is a need for filtering by specific request key.

```php

namespace App\Modules\Core\Interfaces;

interface FilterInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value);
}
```

Example implementation of the **FilterInterface**

```php

namespace App\Modules\Example\Filters;

use App\Modules\Core\Filters\QueryFilter;
use App\Modules\Core\Interfaces\FilterInterface;

class Name extends QueryFilter implements FilterInterface
{
    /**
     * @param $value
     * @return mixed|void
     */
    public function handle($value)
    {
        $this->query->where('name', 'like', '%' . $value . '%');
    }
}
```

### Exceptions

The **Exceptions** directory contains the General exceptions that have some predefined *$code* and *$message* for the exception, this can be overridden when the custom exception per Module extends the General Exception.

As an example in the provided Module **Example** there are multiple exceptions defined

#### ExampleNotFoundException

```php

namespace App\Modules\Example\Exceptions;

use App\Modules\Core\Exceptions\GeneralNotFoundException;

class ExampleNotFoundException extends GeneralNotFoundException
{

}

```

This extends the **GeneralNotFoundException**

```php

namespace App\Modules\Core\Exceptions;

class GeneralNotFoundException extends GeneralException
{
    public $code = 404;

    /**
     * @return string|null
     */
    public function message(): ?string
    {
        return "The requested resource was not found in the database";
    }
}

```

### Requests

The **Requests** directory contains the General Form Request abstract classes.

The main **FormRequest** class overrides the *failedValidation* method from *src/Illuminate/Foundation/Http/FormRequest.php*

```php

abstract class FormRequest extends LaravelFormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
```

Then each of the other abstract Form Request classes extends this abstract **FormRequest**

#### CreateFormRequest

```php

namespace App\Modules\Core\Requests;

abstract class CreateFormRequest extends FormRequest
{
    protected $table = '';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();
}
```

Now when the abstract **CreateFormRequest** is extended in a Module, the class that extends this will have to implement the abstract method *rules()* where the validation rules are defined.

#### CreateExampleRequest

```php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\CreateFormRequest;
use Illuminate\Validation\Rule;

class CreateExampleRequest extends CreateFormRequest
{
    protected $table = 'examples';

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique($this->table, 'name')
            ],
            'example_type_id' => [
                'required',
                Rule::exists('example_types', 'id')
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ],
        ];
    }
}
```

### Traits

The **Traits** directory contains the core traits used in the modules. The *ApiResponses* trait is where the default structure is defined for the Json responses for error and success

Some methods defined there

```php

    /**
     * @param Exception $exception
     * @param array $data
     * @param string $title
     * @return JsonResponse
     */
    public function exceptionRespond(Exception $exception, $data = [], $title = 'Error'): JsonResponse
    {
        return response()->json(
            [
                'title' => $title,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ],
            $exception->getCode());
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function respond($data): JsonResponse
    {
        return response()->json(
                [
                    'message' => $this->message,
                    'code' => $this->responseCode,
                    'data' => $data
                ],
                $this->responseCode);
    }

```

To get the general idea of the Core structure please clone the repository or create new composer project

```
git clone https://github.com/keljtanoski/modular-laravel.git
```

```
composer create-project keljtanoski/modular-laravel
```


## Example module structure
This is an example module ready to be used. The general purpose of this module is to be demonstrate the interaction between the interface, repository and the service, it can be easily duplicated and with simple search and replace you can have new module up and running very fast.

### Directory overview

```
app
├── Modules
│   └── Example
│       ├── Config
|       |   └── .gitkeep
│       ├── Controllers
│       │   ├── Api
│       │   │   └── ExamplesController.php
|       |   └── ExamplesController.php
│       ├── Exceptions
│       |   ├── ExampleDestroyException.php
│       |   ├── ExampleIndexException.php
│       |   ├── ExampleNotFoundException.php
│       |   ├── ExampleSearchException.php
│       |   ├── ExampleStoreException.php
|       |   └── ExampleUpdateException.php
│       ├── Filters
│       |   ├── ExampleType.php
│       |   ├── ExampleTypeId.php
│       |   ├── IsActive.php
|       |   └── Name.php
│       ├── Helpers
|       |   └── .gitkeep
│       ├── Interfaces
|       |   └── ExampleInterface.php
│       ├── Models
|       |   └── Example.php
│       ├── Repositories
|       |   └── ExampleRepository.php
│       ├── Requests
│       |   ├── CreateExampleRequest.php
│       |   ├── DeleteExampleRequest.php
│       |   ├── SearchExampleRequest.php
│       |   ├── ShowExampleRequest.php
|       |   └── UpdateExampleRequest.php
│       ├── Resources
│       |   ├── lang
|       |   |   └── .gitkeep
│       |   └── views
|       |       ├── layouts
|       |       |   └── master.blade.php
|       |       ├── index.blade.php
|       |       └── create.blade.php
│       ├── routes
│       |   ├── api.php
|       |   └── web.php
│       ├── Services
|       |   └── ExampleService.php
│       ├── Traits
|       |   └── .gitkeep
│       ├── Transformers
|       |   └── ExampleResource.php
│       └──
└── 
```

### Controllers

The **Controllers** directory holds the controllers for the module. *ExamplesController* is used for the WEB endpoints and the *Api/ExamplesController* is used for the API endpoints

#### Api/ExamplesController

The *exampleService* is injected through the constructor.
This service is responsible for delegating the action required to a Repository class that implements the *ExampleInterface*.

```php

namespace App\Modules\Example\Controllers\Api;

class ExamplesController extends ApiController
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
```

##### *index()* method

```php
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
```

##### *show()* method

```php
    /**
     * @param ShowExampleRequest $request
     * @return JsonResponse
     * @throws ExampleNotFoundException
     */
    public function show(ShowExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.ok',
                    ['resource' => Helper::getResourceName(
                        $this->exampleService->exampleRepository->model)
                    ]))
                ->respond(new ExampleResource($this->exampleService->getById($request->id)));
        } catch (Exception $exception) {
            throw new ExampleNotFoundException($exception);
        }
    }
```

##### *store()* method

```php
    /**
     * @param CreateExampleRequest $request
     * @return JsonResponse
     * @throws ExampleStoreException
     */
    public function store(CreateExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.storeSuccess',
                    ['resource' => Helper::getResourceName(
                        $this->exampleService->exampleRepository->model)
                    ]))
                ->respond(new ExampleResource($this->exampleService->create($request->validated())));
        } catch (Exception $exception) {
            throw new ExampleStoreException($exception);
        }
    }
```

##### *update()* method

```php
    /**
     * @param UpdateExampleRequest $request
     * @return JsonResponse
     * @throws ExampleUpdateException
     */
    public function update(UpdateExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.updateSuccess',
                    ['resource' => Helper::getResourceName(
                        $this->exampleService->exampleRepository->model)
                    ]))
                ->respond(new ExampleResource($this->exampleService
                    ->update($request->validated())
                ));
        } catch (Exception $exception) {
            throw new ExampleUpdateException($exception);
        }
    }
```

##### *destroy()* method

```php

    /**
     * @param DeleteExampleRequest $request
     * @return JsonResponse
     * @throws ExampleDestroyException
     */
    public function destroy(DeleteExampleRequest $request)
    {
        try {
            return $this
                ->setMessage(__('apiResponse.deleteSuccess',
                    ['resource' => Helper::getResourceName(
                        $this->exampleService->exampleRepository->model)
                    ]))
                ->respond($this->exampleService->delete($request->id));
        } catch (Exception $exception) {
            throw new ExampleDestroyException($exception);
        }
    }
}

```

#### ExamplesController

The WEB - ExamplesController has the standard methods :
* *index()* - returns all the resources
* *create()* - returns view for creating a resource
* *store()* - stores the data from the create form
* *edit()* - returns view for editing a resource
* *update()* - updates the resource with the form data
* *destroy()* - destroys a resource

The same *ExampleService* is used and injected through the constructor.

```php
namespace App\Modules\Example\Controllers;

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

```

### Services

The **Services** directory contains the service classes used in a module.

The *ExampleInterface* is injected through the constructor, this interface is bind to an implementation via a *RepositoryServiceProvider*

```php

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $repositories = [
        ExampleInterface::class => ExampleRepository::class,
        ExampleTypeInterface::class => ExampleTypeRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, function ($app) use ($repository) {
                return new $repository;
            });
        }
    }
```

The *ExampleService* class from this module is structured like this:

```php

namespace App\Modules\Example\Services;

class ExampleService
{
    public $exampleRepository;

    public function __construct(ExampleInterface $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

```

Methods already defined in the *ExampleService* are the following:

#### *getById()* method

```php

    /**
     * @param int $id
     * @return mixed
     * @throws ExampleNotFoundException
     */
    public function getById(int $id)
    {
        try {
            return $this->exampleRepository->findById($id);
        } catch (Exception $exception) {
            throw new ExampleNotFoundException($exception);
        }
    }
```

#### *getAll()* method

```php

    /**
     * @return mixed
     * @throws ExampleIndexException
     */
    public function getAll()
    {
        try {
            return $this->exampleRepository->findAll();
        } catch (Exception $exception) {
            throw new ExampleIndexException($exception);
        }
    }
```

#### *create()* method

```php

    /**
     * @param array $data
     * @return mixed
     * @throws ExampleStoreException
     */
    public function create(array $data)
    {
        try {
            return $this->exampleRepository->create($data);
        } catch (Exception $exception) {
            throw new ExampleStoreException($exception);
        }
    }
```

#### *update()* method

```php

    /**
     * @param array $data
     * @return mixed
     * @throws ExampleUpdateException
     */
    public function update(array $data)
    {
        try {
            return $this->exampleRepository->update($data['id'], $data);
        } catch (Exception $exception) {
            throw new ExampleUpdateException($exception);
        }
    }
```

#### *delete()* method

```php

    /**
     * @param int $id
     * @return mixed|void
     * @throws ExampleDestroyException
     */
    public function delete(int $id)
    {
        try {
            return $this->exampleRepository->delete($id);
        } catch (Exception $exception) {
            throw new ExampleDestroyException($exception);
        }
    }
```

#### *search()* method

```php

/**
     * @param array $data
     * @return mixed|void
     * @throws ExampleSearchException
     */
    public function search(array $data)
    {
        try {
            return $this->exampleRepository->search($data);
        } catch (Exception $exception) {
            throw new ExampleSearchException($exception);
        }
    }
```

To get the general idea of the Module structure please clone the repository or create new composer project

```
git clone https://github.com/keljtanoski/modular-laravel.git
```

```
composer create-project keljtanoski/modular-laravel
```

## Route List
This is just an output of the `php artisan route:list` command

```

+----------+---------------------------+---------------------------+------------------------------------------------------------------------+---------------+
| Method   | URI                       | Name                      | Action                                                                 | Middleware    |
+----------+---------------------------+---------------------------+------------------------------------------------------------------------+---------------+
| POST     | api/v1/example-types      | api.example_types.store   | App\Modules\ExampleType\Controllers\Api\ExampleTypesController@store   | api           |
| GET|HEAD | api/v1/example-types      | api.example_types.index   | App\Modules\ExampleType\Controllers\Api\ExampleTypesController@index   | api           |
| DELETE   | api/v1/example-types/{id} | api.example_types.destroy | App\Modules\ExampleType\Controllers\Api\ExampleTypesController@destroy | api           |
| PATCH    | api/v1/example-types/{id} | api.example_types.update  | App\Modules\ExampleType\Controllers\Api\ExampleTypesController@update  | api           |
| GET|HEAD | api/v1/example-types/{id} | api.example_types.show    | App\Modules\ExampleType\Controllers\Api\ExampleTypesController@show    | api           |
| GET|HEAD | api/v1/examples           | api.examples.index        | App\Modules\Example\Controllers\Api\ExamplesController@index           | api           |
| POST     | api/v1/examples           | api.examples.store        | App\Modules\Example\Controllers\Api\ExamplesController@store           | api           |
| GET|HEAD | api/v1/examples/{id}      | api.examples.show         | App\Modules\Example\Controllers\Api\ExamplesController@show            | api           |
| PATCH    | api/v1/examples/{id}      | api.examples.update       | App\Modules\Example\Controllers\Api\ExamplesController@update          | api           |
| DELETE   | api/v1/examples/{id}      | api.examples.destroy      | App\Modules\Example\Controllers\Api\ExamplesController@destroy         | api           |
| POST     | example-types             | example_types.store       | App\Modules\ExampleType\Controllers\ExampleTypesController@store       | web           |
| GET|HEAD | example-types             | example_types.index       | App\Modules\ExampleType\Controllers\ExampleTypesController@index       | web           |
| GET|HEAD | example-types/create      | example_types.create      | App\Modules\ExampleType\Controllers\ExampleTypesController@create      | web           |
| GET|HEAD | example-types/{id}        | example_types.show        | App\Modules\ExampleType\Controllers\ExampleTypesController@show        | web           |
| PATCH    | example-types/{id}        | example_types.update      | App\Modules\ExampleType\Controllers\ExampleTypesController@update      | web           |
| DELETE   | example-types/{id}        | example_types.destroy     | App\Modules\ExampleType\Controllers\ExampleTypesController@destroy     | web           |
| GET|HEAD | example-types/{id}/edit   | example_types.edit        | App\Modules\ExampleType\Controllers\ExampleTypesController@edit        | web           |
| GET|HEAD | examples                  | examples.index            | App\Modules\Example\Controllers\ExamplesController@index               | web           |
| POST     | examples                  | examples.store            | App\Modules\Example\Controllers\ExamplesController@store               | web           |
| GET|HEAD | examples/create           | examples.create           | App\Modules\Example\Controllers\ExamplesController@create              | web           |
| DELETE   | examples/{id}             | examples.destroy          | App\Modules\Example\Controllers\ExamplesController@destroy             | web           |
| PATCH    | examples/{id}             | examples.update           | App\Modules\Example\Controllers\ExamplesController@update              | web           |
| GET|HEAD | examples/{id}             | examples.show             | App\Modules\Example\Controllers\ExamplesController@show                | web           |
| GET|HEAD | examples/{id}/edit        | examples.edit             | App\Modules\Example\Controllers\ExamplesController@edit                | web           |
+----------+---------------------------+---------------------------+------------------------------------------------------------------------+---------------+

```

## Final thoughts

Each module represents a Use Case, but they can be combined into a Domain, for example *Modules/CMS* can have the following "sub-modules" : Post, Tag, Category etc. I will make an update about this once I have the demo implemented. I am also working on implementing *Presenters* and adding *Tests* so that will also be described in the next release.

***
Please let me know what you think in the comments.

You are, of course, welcome to suggest changes to the repository by submitting a pull-request. Your contribution is much appreciated

Thank you for your time.

This implementation was inspired by [nWidart/laravel-modules] (https://github.com/nWidart/laravel-modules)

***
