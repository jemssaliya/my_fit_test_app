<?php

namespace EMedia\FileControl;

use EMedia\FileControl\Console\Commands\SetupSettings;
use EMedia\Helpers\Console\Commands\ComposerAutoload;
use Illuminate\Support\ServiceProvider;

class FileControlServiceProvider extends ServiceProvider
{

	public function register()
	{
		if (!app()->environment('production')) {
			$this->commands(ComposerAutoload::class);
			$this->commands(SetupSettings::class);
		}
	}

}