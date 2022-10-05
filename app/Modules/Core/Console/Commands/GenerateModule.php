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
        return CoreCommand::SUCCESS;
    }
}
