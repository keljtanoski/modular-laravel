<?php

namespace App\Modules\Core\Console\Commands;

class GenerateModule extends CoreCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Something';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * I.Create command for each directory inside module
         * 1. GenerateModule
         *  - module:generate {moduleName} (default generate all directories with all files}
         * 2. GenerateModuleException
         *  - module:generate:exception {moduleName} {?exceptionName}--all (default)  /Modules/{moduleName}/Exceptions/*
         * 3. GenerateModuleConfig
         *  - module:generate:config {moduleName} /Modules/{moduleName}/Config/
         * 4. GenerateModuleController
         *  - module:generate:controller {moduleName} {?controllerName} --all (default API + WEB) --api Only API, --web Only WEB.
         * 5.
         */
        return CoreCommand::SUCCESS;
    }
}
