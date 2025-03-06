<?php

namespace App\Http\Resources\Api\Project;

use App\Http\Resources\Api\Attribute\AttributeResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Project **/
class ProjectResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'attributes' => $this->whenLoaded('attributes', ProjectAttributeResource::collection($this->attributes)),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
