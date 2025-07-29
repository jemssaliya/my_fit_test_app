<?php

use App\Models\User;
use EMedia\MultiTenant\Facades\TenantManager;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

	public function run()
	{
		if (app()->environment() !== 'production') {
			$this->seedTestUsers();
			$this->seedRegularUsers();
		}
	}

	public function seedRegularUsers()
	{
		$faker = Faker::create('en_AU');

		User::create([
			'name'	 => 'Bruce Wayne (REGULAR USER)',
			'email'	 => 'apps+user@elegantmedia.com.au',
			'password' => bcrypt('123456')
		]);

		foreach(range(1, 10) as $index)
		{
			User::create([
				'name'		    => $faker->title . ' ' . $faker->firstName,
				'email' => $faker->email,
				'password' => bcrypt('123456'),
			]);
		}
	}

	public function seedTestUsers()
	{
		$users = [
			[
				'name'	 => 'Peter Parker (SUPER ADMIN)',
				'email'	 => 'apps@elegantmedia.com.au',
				'password' => bcrypt('123456')
			],
			[
				'name'	 => 'Tony Stark (ADMIN)',
				'email'	 => 'apps+admin@elegantmedia.com.au',
				'password' => bcrypt('123456')
			],
		];

		$i = 0;
		foreach ($users as $key => $data) {
			if (!$user = User::where('email', $data['email'])->first()) {
				$user = User::create($data);

				if (TenantManager::multiTenancyIsActive()) {
					$tenant = app(config('auth.tenantModel'))->find($i + 1);
					TenantManager::setTenant($tenant);
					$user->tenants()->save($tenant);
				}
			}
			$i++;
		}
	}
}
