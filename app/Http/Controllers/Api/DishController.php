<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->perPage ?? 12;
        
        $results = Dish::with('company')->paginate($per_page);

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    }


    public function show(Dish $dish)
    {
        $dish->load(['company', 'company.types']);

        $results = $dish;


        return response()->json([
            'success' => true,
            'results' => $results
        ]);
        
    }
}
