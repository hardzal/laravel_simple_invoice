<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'First User',
            'email' => 'user_first@gmail.com',
            'password' => bcrypt('secret132')
        ]);
    }
}
