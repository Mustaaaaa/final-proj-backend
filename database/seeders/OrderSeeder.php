<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;



class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $json = File::get("database/json/orders.json");
        $data = json_decode($json);

        foreach ($data->orders as $order)
        {
            $new_order = new Order();
            $new_order->customer_name = $order->customer_name;
            $new_order->customer_address = $order->customer_address;
            $new_order->customer_phone = $order->customer_phone;
            $new_order->customer_email = $order->customer_email;
            $new_order->details = $order->details;
            $new_order->total = $order->total;

            //dump($new_order);

            $new_order->save();
        }
    }

}
