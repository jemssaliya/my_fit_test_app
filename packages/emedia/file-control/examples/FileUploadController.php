<?php


namespace EMedia\FileControl\Http\Controllers;


use App\Http\Controllers\Controller;
use EMedia\FileControl\Exceptions\FailedToUploadFileException;
use EMedia\FileControl\Uploader\FileUploader;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{


	public function store(Request $request)
	{
		// TODO: if the upload is greater than the max_upload_size, it returns a FALSE
		// so the max_file_size should be validated by the client before sending an upload

		// checking the file category (optional step)
		$fileType = $request->get('fileType');
		switch ($fileType) {
			case 'logo':
				$uploadDir = config('app.logoDir');
				break;
			default:
				$uploadDir = config('app.imageDir');
		}
		$purpose = $request->get('purpose');

		$fh = new FileUploader($request);
		switch($purpose) {
			case 'TEMP_STORAGE_PUBLIC':
				$fh->saveToDir($uploadDir . 'temp');
				$fh->toDisk('public_access');
				break;
			default:
				$fh->saveToDir($uploadDir)
				   ->fileFieldName('message')
				   ->intoSubDirectoryDateFormat('Ym')
				   ->toDisk('s3_documents')
				   ->resizeImageToMaxWidth(1200)
				   ->withThumbnail(300);
		}

		$response = $fh->upload();

		if ($response->isSuccessful()) {
			return [
				'result'            => $response->isSuccessful(),
				'original_filename' => $response->getOriginalFilename(),
				'relative_path'     => $response->filePath(),
				'url'               => $response->publicUrl(),
				'thumbnail_path'    => $response->thumbnailPath(),
				'thumbnail'         => $response->publicThumbnailUrl(),
			];
		}

		throw new FailedToUploadFileException("Failed to upload the file");
	}

}