<?php

namespace App\Modules\Example\Requests;

use Illuminate\Validation\Rule;

class CreateExampleRequest extends \App\Modules\Core\Requests\CreateFormRequest
{
    protected $table = 'examples';

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique($this->table, 'name')],
            'example_type_id' => ['required', Rule::exists('example_types', 'id')],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
