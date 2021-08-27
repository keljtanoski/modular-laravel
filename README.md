<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
</p>
<p align="center">MODULAR</p>

<p align="center">
<a href="https://packagist.org/packages/keljtanoski/modular-laravel"><img src="https://img.shields.io/packagist/dt/keljtanoski/modular-laravel" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Laravel Latest Stable Version"></a>
<a href="https://packagist.org/packages/keljtanoski/modular-laravel"><img src="https://img.shields.io/packagist/v/keljtanoski/modular-laravel" alt="Modular Laravel Latest Stable Version"></a>

[comment]: <> (<a href="https://packagist.org/packages/keljtanoski/modular-laravel"><img src="https://img.shields.io/packagist/l/keljtanoski/modular-laravel" alt="License"></a>)
</p>

## About Modular Laravel

This project is a personal blueprint starter with customized modular / soa architecture.

[Kostadin Keljtanoski](https://keljtanoski.github.io)

## Install

`composer create-project keljtanoski/modular-laravel`

## Core structure

```
app
├── Modules
│   └── Core
│       ├── Abstracts
|       |   └── QueryFilter.php
│       ├── Builders
|       |   └── FilterBuilder.php
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
│       |   ├── EmptyResource.php
|       |   └── EmptyResourceCollection.php
│       ├── Scopes
|       |   └── .gitkeep
│       ├── Traits
│       |   ├── ApiResponses.php
|       |   └── Filterable.php
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
|       |   └── ExampleResource.php
│       ├── routes
│       |   ├── api.php
|       |   └── web.php
│       ├── Services
|       |   └── ExampleService.php
│       ├── Traits
|       |   └── .gitkeep
│       └──
└── 
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

