<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    protected $files;

    /**
     * Bootstrap the application services.
     *
     * @param Filesystem $files
     * @return void
     */
    public function boot(Filesystem $files): void
    {
        $this->files = $files;
        if (is_dir(app_path(Config::get('modules.default.directory')))) {

            $modules = array_map('class_basename', $this->files->directories(app_path(Config::get('modules.default.directory'))));
            foreach ($modules as $module) {
                // Allow routes to be cached
                $this->registerModule($module);
            }
        }
    }

    /**
     * Register a module by its name
     *
     * @param string $name
     *
     * @return void
     */
    protected function registerModule(string $name): void
    {
        $enabled = config("modules.specific.{$name}.enabled", true);
        if ($enabled) {
            $this->registerRoutes($name);
            $this->registerHelpers($name);
            $this->registerViews($name);
            $this->registerTranslations($name);
            $this->registerFilters($name);
//            $this->registerMigrations($name);
//            $this->registerFactories($name);
        }
    }

    /**
     * Register the routes for a module by its name
     *
     * @param string $module
     *
     * @return void
     */
    protected function registerRoutes(string $module): void
    {
        if (!$this->app->routesAreCached()) {
            $data = $this->getRoutingConfig($module);

            foreach ($data['types'] as $type) {
                $this->registerRoute($module, $data['path'], $data['namespace'], $type);
            }
        }
    }

    /**
     * Collect the needed data to register the routes
     *
     * @param string $module
     *
     * @return array
     */
    protected function getRoutingConfig(string $module): array
    {
        $types = config("modules.specific.{$module}.routing", config('modules.default.routing'));
        $path = config("modules.specific.{$module}.structure.routes", config('modules.default.structure.routes'));

        $cp = config("modules.specific.{$module}.structure.controllers", config('modules.default.structure.controllers'));
        $namespace = $this->app->getNamespace() . trim(Config::get('modules.default.directory') . "\\{$module}\\" . implode('\\', explode('/', $cp)), '\\');

        return compact('types', 'path', 'namespace');
    }

    /**
     * Registers a single route
     *
     * @param string $module
     * @param string $path
     * @param string $namespace
     * @param string $type
     *
     * @return void
     */
    protected function registerRoute(string $module, string $path, string $namespace, string $type): void
    {
        if ($type === 'simple') {
            $file = 'routes.php';
        } else {
            $file = "{$type}.php";
        }

        $file = str_replace('//', '/', app_path(
            Config::get('modules.default.directory')
            . DIRECTORY_SEPARATOR
            . (string)($module)
            . DIRECTORY_SEPARATOR
            . (string)($path)
            . DIRECTORY_SEPARATOR
            . (string)($file)));

        $allowed = ['web', 'api', 'simple', 'admin'];
        if (in_array($type, $allowed) && $this->files->exists($file)) {
            if ($type === 'simple') {
                Route::namespace($namespace)->group($file);
            } else {
                Route::middleware($type)->namespace($namespace)->group($file);
            }
        }
    }

    /**
     * Register the helpers file for a module by its name
     *
     * @param string $module
     *
     * @return void
     */
    protected function registerHelpers(string $module): void
    {
        if ($file = $this->prepareComponent($module, 'helpers', 'helpers.php')) {
            include_once $file;
        }
    }

    /**
     * Prepare component registration
     *
     * @param string $module
     * @param string $component
     * @param string $file
     *
     * @return string
     */
    protected function prepareComponent(string $module, string $component, string $file = '')
    {
        $path = config("modules.specific.{$module}.structure.{$component}", config("modules.default.structure.{$component}"));
        $resource = rtrim(str_replace('//', '/', app_path(Config::get('modules.default.directory') . "/{$module}/{$path}/{$file}")), '/');

        if (!($file && $this->files->exists($resource)) && !(!$file && $this->files->isDirectory($resource))) {
            $resource = false;
        }
        return $resource;
    }

    /**
     * Register the views for a module by its name
     *
     * @param string $module
     *
     * @return void
     */
    protected function registerViews(string $module): void
    {
        if ($views = $this->prepareComponent($module, 'views')) {
            $this->loadViewsFrom($views, $module);
        }
    }

    /**
     * Register the translations for a module by its name
     *
     * @param string $module
     *
     * @return void
     */
    protected function registerTranslations(string $module): void
    {
        if ($translations = $this->prepareComponent($module, 'translations')) {
            $this->loadTranslationsFrom($translations, $module);
        }
    }

    /**
     * @param string $module
     */
    protected function registerFilters(string $module): void
    {
        if ($filters = $this->prepareComponent($module, 'filters')) {
            $this->loadFiltersFrom($filters, $module);
        }
    }

    /**
     * Register a translation file namespace.
     *
     * @param string $path
     * @param string $namespace
     * @return void
     */
    protected function loadFiltersFrom(string $path, string $namespace): void
    {
        $this->callAfterResolving('filters', function ($filter) use ($path, $namespace) {
            $filter->addNamespace($namespace, $path);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPublishConfig();
    }

    /**
     * Publish modules configuration
     *
     * @return void
     */
    protected function registerPublishConfig(): void
    {
        $publishPath = $this->app->configPath('modules.php');
        $this->publishes([$publishPath], 'config');
    }
}
