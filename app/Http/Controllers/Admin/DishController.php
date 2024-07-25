<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Company;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    
    public function index(Request $request)
    {
        $user_id = Auth::id();

        $companies = Company::where('user_id', $user_id)->get();        

        $company_dishes = [];

        foreach ($companies as $company) {
            if($request->has('trash')){
                $dishes = Dish::onlyTrashed()->where('company_id', $company->id)->orderby('name','asc')->get();
            } else{
                $dishes = Dish::where('company_id', $company->id)->orderby('name','asc')->get();
            }
            $company_dishes[$company->name] = $dishes;
        }

        return view('admin.dishes.index', compact('company_dishes', 'companies'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user_id = Auth::id();

        $companies = Company::where('user_id', $user_id)->get();
        
        $company_id = $request->query('company_id', null);

        $selected_company = $company_id;

        return view('admin.dishes.create', compact('companies', 'selected_company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        $form_data = $request->validated();

        $form_data['slug'] = Dish::getUniqueSlug($form_data['name']);

        $form_data['visible'] = $request->has('visible') ? true : false;

        number_format(floatval($form_data['price']), 2, '.'); 

        if($request->hasFile('image')) {
            $image_path = Storage::disk('public')->put('image', $request->image);
            $form_data['image'] = $image_path;
        }

        $new_dish = Dish::create($form_data);

        return to_route("admin.dishes.show", $new_dish);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        $user_id = Auth::id();

        if($dish->company->user_id !== $user_id)
        {
            abort(403, 'Accesso non autorizzato');
        }
        
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $user_id = Auth::id();

        $companies = Company::where('user_id', $user_id)->get();

        if($dish->company->user_id !== $user_id)
        {
            abort(403, 'Accesso non autorizzato');
        }


        return view('admin.dishes.edit', compact('dish', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $form_data = $request->validated();

        $form_data['visible'] = $request->has('visible') ? true : false;

        if($dish->name !== $request->name)
        {
            $form_data['slug'] = Dish::getUniqueSlug($form_data['name']);
        }

        if($request->hasFile('image'))
        {
            $image_path = Storage::disk('public')->put('image', $request->image);

            if($dish->image)
            {
                Storage::disk('public')->delete($dish->image);
            }
    
            $form_data['image'] = $image_path;
        }


        number_format(floatval($dish->price), 2, '.'); 


        $dish->update($form_data);

        return to_route('admin.dishes.show', $dish);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $user_id = Auth::id();

        if($dish->company->user_id !== $user_id)
        {
            abort(403, 'Utente non abilitato a fare questa azione');
        }

        $dish->delete();

        return to_route('admin.dishes.index');
    }



    /**
     * Metodi Aggiuntivi
    */
    public function restore($id)
    {
        $user_id = Auth::id();
        $dish = Dish::withTrashed()->where('id', $id)->first();

        if (!$dish || $dish->company->user_id !== $user_id) {
            abort(403, 'Utente non abilitato a fare questa azione');
        }

        $dish->restore();

        return back();
    }
    public function forceDestroy($id)
    {
        $user_id = Auth::id();
        $dish = Dish::onlyTrashed()->where('id', $id)->first();

        if (!$dish || $dish->company->user_id !== $user_id) {
            abort(403, 'Utente non abilitato a fare questa azione');
        }

        if ($dish->image) {
            Storage::disk('public')->delete($dish->image);
        }

        $dish->forceDelete();
        return back();
    }

    public function showOne($company_id, Request $request)
    {     
        $user_id = Auth::id();

        $company = Company::find($company_id);


        if(!$company)
        {
            abort(404, 'Compagnia non trovata');
        }

        if($company->user_id !== $user_id)
        {
            abort(403, 'Accesso alla pagina non autorizzato');
        }

        if ($request->has('trash')) {
            $dishes = Dish::onlyTrashed()->with('company')->where('company_id', $company_id)->get();
        } else {
            $dishes = Dish::with('company')->where('company_id', $company_id)->get();
        }
 
        $company = Company::find($company_id);
       
        return view('admin.dishes.showOne', compact('company', 'dishes'));
    }
    
}
