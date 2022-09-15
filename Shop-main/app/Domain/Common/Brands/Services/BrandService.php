<?php

namespace App\Domain\Common\Brands\Services;

use App\Domain\Common\Brands\Entities\Brand;
use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;

class BrandService extends BaseService
{
    use FileUploadService;

    public function getEntity(): Entity
    {
        return new Brand();
    }

    public function create(array $object_data)
    {
        $this->serializeTempFile($object_data);
        return parent::create($object_data); // TODO: Change the autogenerated stub
    }

    public function update($object, array $object_data)
    {
        $this->serializeTempFile($object_data);
        return parent::update($object, $object_data); // TODO: Change the autogenerated stub
    }
}
