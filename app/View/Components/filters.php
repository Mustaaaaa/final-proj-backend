<?php

namespace App\View\Components;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class filters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user_id = Auth::user();

        $companies = Company::where('user_id', $user_id->id)->orderby('name')->get();
        return view('components.filters', compact('companies'));
    }
}
