<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'phone' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'user_password' => base64_encode('123456'),
            'status' => 'Active',
        ]);
    }
}
