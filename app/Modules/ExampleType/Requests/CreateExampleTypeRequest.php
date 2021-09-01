<?php

namespace App\Modules\ExampleType\Requests;

use App\Modules\Core\Requests\CreateFormRequest;
use Illuminate\Validation\Rule;

class CreateExampleTypeRequest extends CreateFormRequest
{
    protected $table = 'example_types';

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique($this->table, 'name')
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ],
        ];
    }
}
