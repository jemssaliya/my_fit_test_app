<?php


namespace EMedia\FileControl\Console\Commands;

use EMedia\Helpers\Console\Commands\Packages\BasePackageSetupCommand;

class SetupSettings extends BasePackageSetupCommand
{

	protected $signature = 'setup:package:file-control';
	protected $description = 'Setup the File Control package from EMedia';

	protected $packageName = 'File Control';

	protected $updateRoutesFile = false;

	protected function generateMigrations()
	{
		$this->copyMigrationFile(__DIR__, '001_create_files_table.php', \CreateFilesTable::class);
	}

	protected function generateSeeds()
	{
		// TODO: add a seeder
		// $this->copySeedFile(__DIR__, 'FilesTableSeeder.php', \FilesTableSeeder::class);
	}

}