<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        //leggi file json
        $json = File::get("database/json/dishes.json");
        $data = json_decode($json);

        // Recupero tutti gli ordini
        $orders = Order::all();

        // Creo un array per tenere traccia della compagnia associata a ciascun ordine
        $order_company_map = [];

        foreach ($orders as $order) {
            // Associo ogni ordine a una compagnia
            $company_id = Company::inRandomOrder()->first()->id;
            $order_company_map[$order->id] = $company_id;
        }

        // Inserisco i piatti nella tabella dishes
        foreach ($data->dishes as $dish) {

            $dishId = DB::table('dishes')->insertGetId([
                'name' => $dish->name,
                'slug' => $dish->slug,
                'image' => $dish->image,
                'description' => $dish->description,
                'ingredients' => $dish->ingredients,
                'price' => $dish->price,
                'visible' => $dish->visible,
                'company_id' => $dish->company_id

            ]);

            $dish = Dish::find($dishId);

            // Trova tutti gli ordini associati alla stessa compagnia del piatto corrente
            $order_ids_for_company = array_keys(array_filter($order_company_map, function ($company_id) use ($dish) {
                return $company_id == $dish->company_id;
            }));

            if (!empty($order_ids_for_company)) {
                // Seleziona ordini casuali per il piatto corrente
                $random_order_ids = $faker->randomElements($order_ids_for_company, 1);

                $random_qty = [];
                foreach ($random_order_ids as $order_id) {
                    $random_qty[$order_id] = ['qty' => rand(1, 5)];
                }

                // Attacca il piatto agli ordini selezionati
                $dish->orders()->attach($random_qty);
            }
        }
    }
}
