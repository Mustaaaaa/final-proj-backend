<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class UserCompany implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $request_id = $value;

        $user_id = Auth::id();

        $companies = Company::where('user_id', $user_id)->pluck('id')->toArray();

        //dd($companies);

        $success = in_array($request_id, $companies);

        if($success === false)
        {
            $fail('Compagnia non Valida. Per favore, riprova.');
        }
    }
}
