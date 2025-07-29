<?php


namespace EMedia\DeviceAuthentication;


use Illuminate\Support\ServiceProvider;

class DeviceAuthenticationServiceProvider extends ServiceProvider {

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
		    __DIR__.'/../config/api.php' => config_path('api.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('emedia.deviceauthentication.authentication', function () {
			return $this->app->make('EMedia\DeviceAuthentication\Auth\DeviceAuthentication');
		});
    }
}
