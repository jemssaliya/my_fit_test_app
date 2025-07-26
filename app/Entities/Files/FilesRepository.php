<?php

namespace App\Entities\Files;

use App\Entities\BaseRepository;

class FilesRepository extends BaseRepository
{

    /**
     * FilesRepository constructor.
     * @param File $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function findByUuid($uuid)
    {
        return File::where('uuid', $uuid)->first();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function findByKey($key)
    {
        return File::where('key', $key)->first();
    }

    /**
     * @param $query
     */
    public function addSearchQueryFilters($query)
    {
        $query->where('category', 'admin_uploads');
    }

    /**
     * @param array $uuids
     * @return mixed
     */
    public function getByUuids(array $uuids)
    {
        return File::whereIn('uuid', $uuids)->get();
    }
}
