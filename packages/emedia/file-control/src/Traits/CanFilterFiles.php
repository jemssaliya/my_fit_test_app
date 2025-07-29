<?php
namespace EMedia\FileControl;


use Illuminate\Contracts\Filesystem\FileNotFoundException;

trait CanFilterFiles
{

	/**
	 *
	 * Get all files in a given directory by extension
	 *
	 * @param $directoryPath
	 * @param $fileExtension
	 *
	 * @return array|bool
	 * @throws FileNotFoundException
	 */
	private function getFilesByExtension($directoryPath, $fileExtension, $order = SCANDIR_SORT_ASCENDING, $maxCount = null)
	{
		/*
		$backupFiles = scandir($backupStoragePath, SCANDIR_SORT_DESCENDING);
		$filteredFiles = array_filter($backupFiles, function ($fileName) {
			if (!preg_match('/^(\.DS_Store|\.+)$/', $fileName)) return true;
			return false;
		});
		*/

		if (!is_dir($directoryPath)) throw new FileNotFoundException("The directory {$directoryPath} not found.");

		$files = glob($directoryPath . '/*.' . $fileExtension);

		if (count($files)) {
			switch ($order) {
				case SCANDIR_SORT_DESCENDING:
					$sortedFiles = array_reverse($files);
					if ($maxCount && $maxCount > 0) {
						return array_slice($sortedFiles, 0, $maxCount);
					}
					return $sortedFiles;
					break;
				default:
					return $files;
			}
		}

		return false;
	}

}