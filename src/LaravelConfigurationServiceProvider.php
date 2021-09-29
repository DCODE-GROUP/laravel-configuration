<?php

namespace Dcodegroup\LaravelConfiguration;

use Dcodegroup\LaravelXeroOauth\Commands\InstallCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class LaravelConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->offerPublishing();
        $this->registerCommands();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                                InstallCommand::class,
                            ]);
        }
    }

    /**
     * Setup the resource publishing groups for Dcodegroup Xero oAuth.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if (! Schema::hasTable('configurations') && ! class_exists('CreateConfigurationsTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                                 __DIR__ . '/../database/migrations/create_configurations_table.stub.php' => database_path('migrations/' . $timestamp . '_create_configurations_table.php'),
                             ], 'laravel-configurations-migrations');
        }
    }
}
