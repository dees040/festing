<?php 

namespace dees040\Festing;

use dees040\Festing\Commands\FestCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * This will be used to register the config.
     *
     * @var  string
     */
    protected $packageName = 'festing';

    /**
     * A list of artisan commands for your package
     * 
     * @var array
     */
    protected $commands = [
        FestCommand::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish your config
        $this->publishes([
            __DIR__.'/../config/festing.php' => config_path($this->packageName.'.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/festing.php', $this->packageName
        );
    }
}
