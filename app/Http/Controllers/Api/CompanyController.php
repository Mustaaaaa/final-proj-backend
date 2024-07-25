<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {      
        $per_page = $request->perPage ?? 12;

        $results = Company::with('types')->paginate($per_page);

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }

    public function show(Company $company)
    {
        $company->load(['dishes', 'types']);

        $results = $company;


        return response()->json([
            'success' => true,
            'results' => $results
        ]);
        
    }
}
