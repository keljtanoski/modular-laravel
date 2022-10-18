<?php

namespace App\Modules\ExampleType\Requests;

use App\Modules\Core\Requests\UpdateFormRequest;
use Illuminate\Validation\Rule;

class UpdateExampleTypeRequest extends UpdateFormRequest
{
    protected string $table = 'example_types';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => [
                Rule::exists($this->table, 'id')
            ],
            'name' => [
                'sometimes',
                'string',
                Rule::unique($this->table)->ignore($this->id)
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ]
        ];
    }
}
