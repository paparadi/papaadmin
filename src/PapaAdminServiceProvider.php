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
	}
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFromm(
			__DIR__.'/config/admin.php', 'auth'
		);
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
}
?>