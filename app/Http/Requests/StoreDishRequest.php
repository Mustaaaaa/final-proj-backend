<?php

namespace App\Http\Requests;

use App\Rules\UserCompany;
use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
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
            'name'=> 'required|max:255',
            'price' => 'required|numeric|between:0,9999',
            'image'=> 'nullable|image|max:2000',
            'ingredients'=> 'required|max:2500',
            'description'=> 'nullable|max:2500',
            'visible'=> 'boolean|',            
            'company_id'=> [new UserCompany],
        ];
    }
}
