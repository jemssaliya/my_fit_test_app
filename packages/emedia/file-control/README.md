# Laravel Package to Store and Upload Files to Local Disk or AWS S3

Supports Laravel 5.4+ / 6.0


### Installation

Add the repository through your `composer.json`
```
    "repositories": [
        {
            "type":"vcs",
            "url":"git@bitbucket.org:elegantmedia/laravel-helpers.git"
        },
        {
            "type":"vcs",
            "url":"git@bitbucket.org:elegantmedia/file-control-laravel.git"
        },
        {
            "type":"vcs",
            "url":"git@bitbucket.org:elegantmedia/mediamanager-laravel.git"
        }
    ],
```

Then add the package from the CLI
```
composer require emedia/file-control
```

## Configuration

The package will be auto-discovered.

1. Setup the package

This will create the default migration files. Skip this step if you prefer to create your own migrations (not recommended)
```
php artisan setup:package:file-control-package
```

3. Run the migrations
```
php artisan migrate
```

4. Set the disk configuration on `config\filesystems.php`

You can use an existing disk, or create a new storage disk.
Examples:
```
'disks' => [
    'local' => [
        'driver' => 'local',
        'root' => storage_path('app'),
    ],

    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],

	// store all files in `yourdomain.com/content` for public access
	'public_content' => [
		'driver' => 'local',
		'root' => storage_path('app/public/content'),
		'url' => env('APP_URL').'/storage',
		'visibility' => 'public',
	],

    's3' => [
        'driver' => 's3',
        'key' => env('AWS_KEY'),
        'secret' => env('AWS_SECRET'),
        'region' => env('AWS_REGION'),
        'bucket' => env('AWS_BUCKET'),
    ],

    // store all files in a S3 bucket, and serve privately
    // (i.e. allow only authenticated users to view the files)
    's3_documents' => [
        'driver' => 's3',
        'key' => env('AWS_S3_DOCUMENTS_KEY'),
        'secret' => env('AWS_S3_DOCUMENTS_SECRET'),
        'region' => env('AWS_S3_DOCUMENTS_REGION'),
        'bucket' => env('AWS_S3_DOCUMENTS_BUCKET'),
        'protocol' => env('AWS_S3_DOCUMENTS_SERVE_PROTOCOL', 'http'),
        'host' => env('AWS_S3_DOCUMENTS_SERVE_HOST'),
    ],
],

```

### Usage

Upload a file from the HTTP request.
```
$request = request();

$uploader = new FileUploader($request);
$uploader->saveToDir('/project_assets/' . $project->id);    // directory to save to
		 ->toDisk('local');                                 // the disk name from `filesystems.php`
$response = $uploader->upload();
```

See the `examples` directory for an example controller

Other available methods. Method calls can be chained.

```
withRequest($request);      // upload the file from the request
fileFieldName('file');      // set the name of the field on HTML form. Defaults to 'file'.

withLocalFile($localPath);  // upload a file from the local absolute server path (don't use this with 'withRequest'

toDisk('local');            // the disk to save to. Defaults to the 'default' disk in your system
saveToDir('my-dir-name');   // the relative directory to save the file to
intoSubDirectoryDateFormat('Ymd');  // give a sub-directory date format for better file organisation

keepOriginalFileName()      // retain the orignal file name during upload. By default each file will have a unique name

Images
resizeImageToMaxWidth(1200) // resize image to a max width, keeping aspect ratio
resizeImageToMaxHeight(200) // resize image to a max height, keeping aspect ratio
convertImageToFormat('jpg', 80) // convert an uploaded image to the given format
withThumbnail()             // auto-generate a thumbnail
isImage()                   // is this file an image?

// Finally
upload();                   // to the upload
```

The response will return a `FileUploaderResponse` object.

The following methods are available on the response
```
isSuccessful();         // true or false
publicThumbnailUrl();   // URL of thumbnail (if it was generated)
thumbnailPath();        // thumbnail path

dirPath();
filePath();
fileName();
diskName();
publicUrl();
getOriginalFilename();
getFileSize();
```

### Updates/issues?

Create a new branch and send a pull request.
