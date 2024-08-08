<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codeNo' => 'required',
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'inStock' => 'required',
            'category_id' => 'required',
            'description' => 'required',

        ];
    }

    public function messages(){
        return [
            'codeNo.required' => 'Code No ဖြည့်ဖို့လိုအပ်ပါသည်။',
            'name.required' => 'Name ဖြည့်ဖို့လိုအပ်ပါသည်။',

        ];
    }
}
