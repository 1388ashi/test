<?php

namespace Modules\Post\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
    */
    public function rules(): array
    {
        $categoryId = $this->input('category_id');
        return [
            'status' => 'in:0,1'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
