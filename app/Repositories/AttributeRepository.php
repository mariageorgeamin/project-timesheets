<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepositoryInterface;

class AttributeRepository implements AttributeRepositoryInterface
{
    public function getAllAttributes()
    {
        return Attribute::all();
    }

    public function createAttribute(array $data)
    {
        return Attribute::create($data);
    }

    public function getAttributeById(Attribute $attribute)
    {
        return $attribute;
    }

    public function updateAttribute(Attribute $attribute, array $data)
    {
        $attribute->update($data);
        return $attribute;
    }

    public function deleteAttribute(Attribute $attribute)
    {
        return $attribute->deleteOrFail();
    }
}
