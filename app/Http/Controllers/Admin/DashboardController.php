<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        $user_id = Auth::id();

        $user_name = Auth::user()->name;

        $companies = Company::with('dishes')->where('user_id', $user_id)->get();

        
        return view('admin.dashboard', compact('companies', 'user_name'));
    }
}
