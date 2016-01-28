<?php

use Illuminate\Database\Seeder;
use Flisk\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Flisk\Admin::class, 3)->create();

        Admin::create([
            'first_name' => 'Gareth',
            'last_name' => 'Nicholson',
            'username' => 'Gareth',
            'email' => 'gareth.nic@gmail.com',
            'timezone' => 'Africa/Johannesburg',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10)]);
    }
}
