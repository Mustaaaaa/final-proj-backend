<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();

        if ($request->has('trash')) {
            $companies = Company::onlyTrashed()->where('user_id', $user_id)->get();
        } else {
            $companies = Company::where('user_id', $user_id)->get();
        }

        return view("admin.companies.index", compact("companies"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy("name", "asc")->get();

        return view("admin.companies.create", compact("types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $user_id = Auth::id();

        $form_data = $request->validated();// per la validazione

        $form_data['slug'] = Company::getUniqueSlug($form_data['name']);

        if ($request->hasFile('image')) {
            $image_path = Storage::disk('public')->put('image', $request->image);
            $form_data['image'] = $image_path;
        }

        $form_data['user_id'] = $user_id;

        $new_company = Company::create($form_data);

        if ($request->has('types')) {
            $new_company->types()->attach($form_data['types']);
        }


        // $new_company->save();


        return to_route("admin.companies.show", $new_company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $user_id = Auth::id();

        if ($company->user_id !== $user_id) {
            abort(403, 'Accesso non autorizzato');
        }

        $company->load(['user', 'user.companies', 'types', 'types.companies']);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $user_id = Auth::id();

        if ($company->user_id !== $user_id) {
            abort(403, 'Accesso non autorizzato');
        }

        $company->load(['types']);
        $types = Type::orderBy("name", "asc")->get();

        return view("admin.companies.edit", compact("company", 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $user_id = Auth::id();

        if ($company->user_id !== $user_id) {
            abort(403, 'Modifiche non autorizzate, puoi modificare solo i tuoi ristoranti');
        }

        $form_data = $request->validated();// per la validazione


        if ($company->name !== $request->name) {
            $form_data['slug'] = Company::getUniqueSlug($form_data['name']);
        }


        if ($request->hasFile('image')) {
            $image_path = Storage::disk('public')->put('image', $request->image);
            if ($company->image) {
                Storage::disk('public')->delete($company->image);
            }
            $form_data['image'] = $image_path;
        }

        $company->update($form_data);

        if ($request->has('types')) {

            $company->types()->sync($request->types);
        } else {
            $company->types()->detach();
        }

        return to_route("admin.companies.show", $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $user_id = Auth::id();

        if ($company->user_id !== $user_id) {
            abort(403, 'Non puoi eliminare questo ristorante, puoi eliminare solo i tuoi ristoranti');
        }

        $company->delete();
        return to_route("admin.companies.index");
    }
    public function restore($id)
    {
        $user_id = Auth::id();

        $company = Company::withTrashed()->where('id', $id)->where('user_id', $user_id)->first();

        if (!$company) {
            abort(403, 'Utente non autorizzato ad eseguire questa azione');
        }

        $company->restore();

        return back();
    }
    public function forceDestroy($id)
    {
        $user_id = Auth::id();

        $company = Company::onlyTrashed()->where('id', $id)->where('user_id', $user_id)->first();

        if (!$company) {
            abort(403, 'Utente non autorizzato ad eseguire questa azione');
        }

        if ($company->image) {
            Storage::disk('public')->delete($company->image);
        }

        $company->forceDelete();
        
        return back();
    }
}
