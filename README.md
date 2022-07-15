![Logo](https://repository-images.githubusercontent.com/400247224/3f248688-2547-4d7b-adea-a10f6ab19b6a)

<p align="center">
<a href="https://packagist.org/packages/keljtanoski/modular-laravel"><img src="https://img.shields.io/packagist/dt/keljtanoski/modular-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Laravel Latest Stable Version"></a>
<a href="https://packagist.org/packages/keljtanoski/modular-laravel"><img src="https://img.shields.io/packagist/v/keljtanoski/modular-laravel" alt="Modular Laravel Latest Stable Version"></a>
</p>

## About Modular Laravel

This project is a personal blueprint starter with customized modular / SOA architecture.

[Kostadin Keljtanoski](https://keljtanoski.github.io)

## Install

You can create new Modular Laravel project using composer

`composer create-project keljtanoski/modular-laravel`

After the project is created run the following commands

`composer install`

Then generate application key

`php artisan key:generate`

Then create storage link

`php artisan storage:link`

Then run the migrations

`php artisan migrate:fresh`

## Laravel Sail

This blueprint comes with Laravel Sail included and default configuration including `mysql` and `redis` in the `docker-composer.yml` file.
You can select your own setup or preference by running `php artisan sail:install` in the terminal and select the desired configuration.

To start Docker containers run

`./vendor/bin/sail up` 

This will pull the docker images and start the containers.

Alternatively you can run the following command to start the Docker containers in the background

`./vendor/bin/sail up -d`

After the Docker containers are up and ready you can run the following command to run the migrations inside Docker

`./vendor/bin/sail artisan migrate:fresh`

Then run the seeders for the example modules

`./vendor/bin/sail artisan db:seed`

## Core structure

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

## Example Module structure

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

## Route list

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

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

