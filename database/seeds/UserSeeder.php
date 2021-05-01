<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            \Illuminate\Support\Facades\DB::table('users')->insert([
                 'name'=>"Rado",
                'email'=>"admin@gmail.com",
                'activated'=>true,
                "password"=>bcrypt('123456789'),
            ]);

    }
}
