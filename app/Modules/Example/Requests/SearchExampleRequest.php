<?php

namespace App\Modules\Example\Requests;

use App\Modules\Core\Requests\SearchFormRequest;
use Illuminate\Validation\Rule;

class SearchExampleRequest extends SearchFormRequest
{
    protected $table = 'examples';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes'],
            'example_type_id' => ['sometimes'],
            'example_type' => ['sometimes'],
            'list' => ['sometimes', 'boolean'],
            'created_at' => ['sometimes'],
            'updated_at' => ['sometimes'],
            'order_by' => [
                'sometimes',
                Rule::in([
                    'id',
                    'name',
                    'example_type_id',
                    'example_type',
                    'created_at',
                    'updated_at',
                ])],
            'sort' => [
                'sometimes',
                Rule::in([
                    'asc',
                    'desc'
                ])
            ],
            'per_page' => [
                'sometimes',
                'int'
            ]
        ];
    }
}
