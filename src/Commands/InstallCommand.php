<?php

namespace Dcodegroup\LaravelConfiguration\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-configurations:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Laravel Configurations resources';

    /**
     * @return void
     */
    public function handle()
    {
        if (! Schema::hasTable('configurations') && ! class_exists('CreateConfigurationTable')) {
            $this->comment('Publishing Laravel Configurations Migrations');
            $this->callSilent('vendor:publish', ['--tag' => 'laravel-configurations-migrations']);
        }

        $this->info('Laravel Xero scaffolding installed successfully.');
    }
}
