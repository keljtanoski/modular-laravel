<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\UpdateFormRequest;
use Illuminate\Validation\Rule;

class UpdateExampleRequest extends UpdateFormRequest
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
            'id' => [
                Rule::exists($this->table, 'id')
            ],
            'name' => [
                'sometimes',
                'string',
                Rule::unique($this->table)->ignore($this->id)
            ],
            'description' => [
                'sometimes',
                'string',
            ],
            'example_type_id' => [
                'sometimes',
                Rule::exists('example_types', 'id')
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ]
        ];
    }
}
