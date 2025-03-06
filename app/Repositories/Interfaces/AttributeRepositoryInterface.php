<?php

namespace App\Repositories\Interfaces;

use App\Models\Attribute;

interface AttributeRepositoryInterface
{
    public function getAllAttributes();
    public function createAttribute(array $data);
    public function getAttributeById(Attribute $attribute);
    public function updateAttribute(Attribute $attribute, array $data);
    public function deleteAttribute(Attribute $attribute);
}
