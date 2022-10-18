<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\CreateFormRequest;
use Illuminate\Validation\Rule;

class CreateExampleRequest extends CreateFormRequest
{
    /**
     * @var string
     */
    protected string $table = 'examples';

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
            'description' => [
                'nullable',
                'string',
            ],
            'example_type_id' => [
                'required',
                Rule::exists('example_types', 'id')
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ],
        ];
    }
}
