<?php

namespace App\Services;

use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepositoryInterface;

class AttributeService
{
    protected $attributeRepository;

    public function __construct(AttributeRepositoryInterface $attributeRepository) {
        $this->attributeRepository = $attributeRepository;
    }

    public function getAllAttributes() {
        return $this->attributeRepository->getAllAttributes();
    }

    public function createAttribute($data) {
        return $this->attributeRepository->createAttribute($data);
    }

    public function getAttributeById(Attribute $attribute) {
        return $this->attributeRepository->getAttributeById($attribute);
    }

    public function updateAttribute(Attribute $attribute, array $data) {
        return $this->attributeRepository->updateAttribute($attribute, $data);
    }

    public function deleteAttribute(Attribute $attribute) {
        return $this->attributeRepository->deleteAttribute($attribute);
    }
}
