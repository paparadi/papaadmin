<?php

namespace Paparadi\Papaadmin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Arr;


class PapaAdminServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadRoutesFrom(__DIR__.'/routes/web.php');
		$this->loadViewsFrom(__DIR__.'/resources/views', 'Papaadmin');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->bootBladeDirectives();
        $this->publishes([
            __DIR__.'/resources/views/' => resource_path('views'),
        ], 'views');
        $this->publishes([
            __DIR__.'/public' => public_path(''),
        ], 'public');
        $this->publishes([
            __DIR__.'/Database/migrations' => database_path('migrations'),
        ], 'migrations');
	}
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFromm(
			__DIR__.'/config/auth.php', 'auth'
		);
		$this->commands([
			Console\Commands\PapaadminInit::class,
			Console\Commands\PapaadminAdd::class,
        ]);
	}
	 /**
	 * Merge the given configuration with the existing configuration.
	 *
	 * @param  string  $path
	 * @param  string  $key
	 * @return void
	 */
	protected function mergeConfigFromm($path, $key)
	{
		$config = $this->app['config']->get($key, []);

		$this->app['config']->set($key, $this->mergeConfigs(require $path, $config));
	}

	/**
	 * Merges the configs together and takes multi-dimensional arrays into account.
	 *
	 * @param  array  $original
	 * @param  array  $merging
	 * @return array
	 */
	protected function mergeConfigs(array $original, array $merging)
	{
		$array = array_merge($merging, $original);

		foreach ($original as $key => $value) {
			if (! is_array($value)) {
				continue;
			}

			if (! Arr::exists($merging, $key)) {
				continue;
			}

			if (is_numeric($key)) {
				continue;
			}

			$array[$key] = $this->mergeConfigs($value, $merging[$key]);
		}
		return $array;
	}
	/**
     * Add Custom Blade Directives
     * 
     */
    protected function bootBladeDirectives(){
        Blade::if('can', function($expression){
            return auth('admin')->user()->can($expression);
        });
    }
}
?>