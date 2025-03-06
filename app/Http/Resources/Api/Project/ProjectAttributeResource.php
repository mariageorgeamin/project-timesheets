<?php

namespace App\Http\Resources\Api\Project;

use App\Http\Resources\Api\Attribute\AttributeResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Project **/
class ProjectAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->attribute->name,
            'value' => $this->value,
        ];
    }
}
