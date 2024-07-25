<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $users = ['Donato Riccio', 'Gianluca Lomarco', 'Gianni Saladino', 'Francesca Barletta', 'Marco Colloca', 'Samuel Panicucci'];


        
        foreach ($users as $user_name)
        {
            User::create([
                'name' => $user_name,
                'email' => strtolower(str_replace(' ','',$user_name)) . '@mail.com',
                'password' => Hash::make('user'),
            ]);
        }
        
        User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
