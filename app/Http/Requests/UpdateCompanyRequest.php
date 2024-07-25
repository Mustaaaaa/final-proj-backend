<?php

namespace App\Http\Requests;
use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
            "vat_number"=> ['required','digits:11', Rule::unique('companies')->ignore($this->company->id)],
            "description"=> "nullable|max:2500",
            "phone_number"=> ['required', 'max:50', Rule::unique('companies')->ignore($this->company->id)],
            "email"=> ['required','max:255', Rule::unique('companies')->ignore($this->company->id)],
            "types"=> "exists:types,id|required",
         

        ];
    }
}
