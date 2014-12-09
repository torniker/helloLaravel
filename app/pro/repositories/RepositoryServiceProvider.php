<?php namespace pro\repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind('pro\repositories\UserRepository\UserRepositoryInterface', 'pro\repositories\UserRepository\UserRepositoryDb');
	}
}