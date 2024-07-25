<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Leggi il file JSON
        $json = File::get("database/json/companies.json");
        $data = json_decode($json);

        foreach ($data->companies as $company) {
            // Inserisci i dati nella tabella companies
            $companyId = DB::table('companies')->insertGetId([
                'name' => $company->name,
                'slug' => $company->slug,
                'image' => $company->image,
                'address' => $company->address,
                'city' => $company->city,
                'vat_number' => $company->vat_number,
                'phone_number' => $company->phone_number,
                'description' => $company->description,
                'email' => $company->email,
                'user_id' => $company->user_id,
            ]);

            // Inserisci i dati nella tabella ponte company_type
            foreach ($company->types as $typeId) {
                DB::table('company_type')->insert([
                    'company_id' => $companyId,
                    'type_id' => $typeId,
                ]);
            }
        }
    }
}
