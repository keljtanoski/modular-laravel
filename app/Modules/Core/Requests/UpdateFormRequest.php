<?php

namespace App\Modules\Core\Requests;

abstract class UpdateFormRequest extends FormRequest
{
    protected $table = '';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function validationData(): array
    {
        return array_merge($this->request->all(), [
            'id' => $this->route()->parameter('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();
}
