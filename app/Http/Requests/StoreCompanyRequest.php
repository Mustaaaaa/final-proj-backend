<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            "name"=> "required|max:255",
            "image"=> "nullable|image|max:2000",
            "city"=> "required|max:255",
            "address"=> "required|max:255",
            "vat_number"=> "required|digits:11|unique:companies,vat_number",
            "description"=> "nullable|max:2500",
            "phone_number"=> "required|max:50|unique:companies,phone_number",
            "email"=> "required|max:255|unique:companies,email",
            "types"=> "exists:types,id|required",
        ];
    }
}
