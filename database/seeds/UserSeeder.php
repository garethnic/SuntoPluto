<?php

use Illuminate\Database\Seeder;
use Flisk\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Flisk\User::class, 5)->create();

        User::create([
        'first_name' => 'Gareth',
        'last_name' => 'Nicholson',
        'gender' => 'm',
        'confirmed' => 1,
        'Username' => 'Gareth',
        'email' => 'gareth.nic@gmail.com',
        'password' => bcrypt('password'),
        'remember_token' => str_random(10)]);
    }
}
