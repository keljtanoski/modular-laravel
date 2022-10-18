<?php

namespace App\Modules\ExampleType\Requests;

use App\Modules\Core\Requests\CreateFormRequest;
use Illuminate\Validation\Rule;

class CreateExampleTypeRequest extends CreateFormRequest
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
