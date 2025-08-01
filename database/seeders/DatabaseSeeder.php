<?php

use EMedia\MultiTenant\Facades\TenantManager;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

	public function run()
	{
		Model::unguard();

		// seed tenants (excluding production environment)
		if (TenantManager::multiTenancyIsActive()) $this->call(TenantsTableSeeder::class);

		$this->call(AbilityCategoriesTableSeeder::class);
		$this->call(AbilitiesTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(RoleAbilitiesTableSeeder::class);

		// Add development, testing, staging seeders here.
		if (!app()->environment('production')) {
			$this->call(UsersTableSeeder::class);
			$this->call(UserRolesTableSeeder::class);


		}

		/*
		|-------------------------------------------------------------------------------
		| Add production-safe seeders here. DO NOT ADD HERE IF IT ALTERS EXISTING DATA
		|-------------------------------------------------------------------------------
		*/

		Model::reguard();
	}

}
