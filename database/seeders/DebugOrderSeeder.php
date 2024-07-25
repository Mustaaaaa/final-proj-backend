<?php

namespace Database\Seeders;
use App\Models\Company;
use App\Models\Dish;
use App\Models\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebugOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //leggi file json
        $json = File::get("database/json/dishes.json");
        $data = json_decode($json);

        //prendo l'id dei piatti della compagnia scelata e li metto in un array
        $dishes_4 = Dish::where('company_id', 4)->pluck('id');
        
        $dishes_1 = Dish::where('company_id', 1)->pluck('id');
        $dishes_2 = Dish::where('company_id', 2)->pluck('id');
        $dishes_3 = Dish::where('company_id', 3)->pluck('id');
        $dishes_5 = Dish::where('company_id', 5)->pluck('id');
        $dishes_6 = Dish::where('company_id', 6)->pluck('id');
        $dishes_7 = Dish::where('company_id', 7)->pluck('id');
        $dishes_8 = Dish::where('company_id', 8)->pluck('id');
        $dishes_9 = Dish::where('company_id', 9)->pluck('id');
        $dishes_10 = Dish::where('company_id', 10)->pluck('id');
        // dump($dishes_9);
        
        $name_customers = ['Paolo', 'Marco', 'Francesca', 'Moustafa' ,'Gianni', 'Samuel', 'Donato', 'Gianluca', 'Massimo', 'Diego'];
        $surname_customers = ['Calcagni', 'Colloca', 'Ibrahim' , 'Barletta', 'Saladino', 'Riccio', 'Panicucci', 'Piazza', 'Giraudo', 'Lomarco'];
        // Creo un array per tenere traccia della compagnia associata a ciascun ordine
        $debug_order_company_map = [];

        for ($i = 0; $i < 23; $i++) {
            $test_order_1 = new Order();
            $test_order_1->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_1->customer_address = $faker->streetAddress();
            $test_order_1->customer_phone = $faker->phoneNumber();
            $test_order_1->customer_email = $faker->email();
            $test_order_1->details = $faker->sentences(2, 10);
            $test_order_1->total = $faker->numberBetween(40, 210);
            $test_order_1->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_1->save();

            $random_dish = $faker->randomElement($dishes_1);

            $test_order_1->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 15; $i++) {
            $test_order_2 = new Order();
            $test_order_2->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_2->customer_address = $faker->streetAddress();
            $test_order_2->customer_phone = $faker->phoneNumber();
            $test_order_2->customer_email = $faker->email();
            $test_order_2->details = $faker->sentences(2, 10);
            $test_order_2->total = $faker->numberBetween(40, 210);
            $test_order_2->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_2->save();

            $random_dish = $faker->randomElement($dishes_2);

            $test_order_2->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 18; $i++) {
            $test_order_3 = new Order();
            $test_order_3->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_3->customer_address = $faker->streetAddress();
            $test_order_3->customer_phone = $faker->phoneNumber();
            $test_order_3->customer_email = $faker->email();
            $test_order_3->details = $faker->sentences(2, 10);
            $test_order_3->total = $faker->numberBetween(40, 210);
            $test_order_3->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_3->save();

            $random_dish = $faker->randomElement($dishes_3);

            $test_order_3->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 50; $i++) {
            $test_order_4 = new Order();
            $test_order_4->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_4->customer_address = $faker->streetAddress();
            $test_order_4->customer_phone = $faker->phoneNumber();
            $test_order_4->customer_email = $faker->email();
            $test_order_4->details = $faker->sentences(2, 10);
            $test_order_4->total = $faker->numberBetween(40, 210);
            $test_order_4->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_4->save();

            $random_dish = $faker->randomElement($dishes_4);

            $test_order_4->dishes()->attach($random_dish);

            // dump($test_order_4);
        }

        for ($i = 0; $i < 14; $i++) {
            $test_order_5 = new Order();
            $test_order_5->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_5->customer_address = $faker->streetAddress();
            $test_order_5->customer_phone = $faker->phoneNumber();
            $test_order_5->customer_email = $faker->email();
            $test_order_5->details = $faker->sentences(2, 10);
            $test_order_5->total = $faker->numberBetween(40, 210);
            $test_order_5->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_5->save();

            $random_dish = $faker->randomElement($dishes_5);

            $test_order_5->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 22; $i++) {
            $test_order_6 = new Order();
            $test_order_6->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_6->customer_address = $faker->streetAddress();
            $test_order_6->customer_phone = $faker->phoneNumber();
            $test_order_6->customer_email = $faker->email();
            $test_order_6->details = $faker->sentences(2, 10);
            $test_order_6->total = $faker->numberBetween(40, 210);
            $test_order_6->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_6->save();

            $random_dish = $faker->randomElement($dishes_6);

            $test_order_6->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 21; $i++) {
            $test_order_7 = new Order();
            $test_order_7->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_7->customer_address = $faker->streetAddress();
            $test_order_7->customer_phone = $faker->phoneNumber();
            $test_order_7->customer_email = $faker->email();
            $test_order_7->details = $faker->sentences(2, 10);
            $test_order_7->total = $faker->numberBetween(40, 210);
            $test_order_7->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_7->save();

            $random_dish = $faker->randomElement($dishes_7);

            $test_order_7->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 33; $i++) {
            $test_order_8 = new Order();
            $test_order_8->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_8->customer_address = $faker->streetAddress();
            $test_order_8->customer_phone = $faker->phoneNumber();
            $test_order_8->customer_email = $faker->email();
            $test_order_8->details = $faker->sentences(2, 10);
            $test_order_8->total = $faker->numberBetween(40, 210);
            $test_order_8->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_8->save();

            $random_dish = $faker->randomElement($dishes_8);

            $test_order_8->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 41; $i++) {
            $test_order_9 = new Order();
            $test_order_9->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_9->customer_address = $faker->streetAddress();
            $test_order_9->customer_phone = $faker->phoneNumber();
            $test_order_9->customer_email = $faker->email();
            $test_order_9->details = $faker->sentences(2, 10);
            $test_order_9->total = $faker->numberBetween(40, 210);
            $test_order_9->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_9->save();

            $random_dish = $faker->randomElement($dishes_9);

            $test_order_9->dishes()->attach($random_dish);

        }

        for ($i = 0; $i < 10; $i++) {
            $test_order_10 = new Order();
            $test_order_10->customer_name = $faker->randomElement($name_customers).' '.$faker->randomElement($surname_customers);
            $test_order_10->customer_address = $faker->streetAddress();
            $test_order_10->customer_phone = $faker->phoneNumber();
            $test_order_10->customer_email = $faker->email();
            $test_order_10->details = $faker->sentences(2, 10);
            $test_order_10->total = $faker->numberBetween(40, 210);
            $test_order_10->created_at = $faker->dateTimeBetween('-1 year','now');


            $test_order_10->save();

            $random_dish = $faker->randomElement($dishes_10);

            $test_order_10->dishes()->attach($random_dish);

        }






    }
}
