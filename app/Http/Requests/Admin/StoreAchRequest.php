<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name.*'=>'required|string',
            'small_des.*'=>'nullable|string',
            'value'=>'required|integer',
            'max_value'=>'nullable|integer',
            'image'=>'nullable|image|max:2025',
        ];
    }
}
