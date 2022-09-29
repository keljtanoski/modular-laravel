<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\UpdateFormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UpdateExampleRequest extends UpdateFormRequest
{
    protected string $table = 'examples';

    /**
     * @inheritDoc
     */
    #[ArrayShape([
        'id' => "array",
        'name' => "array",
        'description' => "string[]",
        'example_type_id' => "array",
        'is_active' => "string[]"
    ])] public function rules(): array
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
