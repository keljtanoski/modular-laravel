<?php

namespace App\Modules\Example\Transformers;

use App\Modules\Core\Transformers\CoreJsonResource;
use App\Modules\ExampleType\Transformers\ExampleTypeResource;
use Illuminate\Http\Request;

class ExampleResource extends CoreJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'example_type_id' => new ExampleTypeResource($this->example_type),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
