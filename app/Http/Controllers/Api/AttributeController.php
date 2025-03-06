<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Attribute\StoreAttributeRequest;
use App\Http\Requests\Api\Attribute\UpdateAttributeRequest;
use App\Http\Resources\Api\Attribute\AttributeResource;
use App\Models\Attribute;
use App\Services\AttributeService;
use App\Traits\ResponseTrait;

class AttributeController extends Controller
{
    use ResponseTrait;

    protected AttributeService $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index()
    {
        return $this->respondWithSuccess(
            'List attributes successfully.' ,
            AttributeResource::collection($this->attributeService->getAllAttributes())
        );
    }

    public function store(StoreAttributeRequest $request)
    {
        $data = $request->validated();

        return $this->respondWithSuccess(
            'Attribute stored successfully.' ,
            AttributeResource::make($this->attributeService->createAttribute($data))
        );
    }

    public function show(Attribute $attribute)
    {
        return $this->respondWithSuccess(
            'Attribute data returned successfully.' ,
            AttributeResource::make($this->attributeService->getAttributeById($attribute))
        );
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute) {
        $data = $request->validated();

        return $this->respondWithSuccess(
            'Attribute data updated successfully.' ,
            AttributeResource::make($this->attributeService->updateAttribute($attribute, $data))
        );
    }

    public function destroy(Attribute $attribute) {
        $this->attributeService->deleteAttribute($attribute);

        return $this->respondWithSuccess(
            'Attribute deleted successfully.',
            []
        );
    }
}
