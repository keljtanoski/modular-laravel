<?php

namespace App\Modules\ExampleType\Requests;

use Illuminate\Validation\Rule;

class UpdateExampleTypeRequest extends \App\Modules\Core\Requests\UpdateFormRequest
{
    protected $table = 'example_types';

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            'id' => [
                Rule::exists($this->table, 'id')
            ],
            'name' => ['sometimes', 'string', Rule::unique($this->table)->ignore($this->id)],
            'is_active' => ['sometimes', 'boolean']
        ];
    }
}
