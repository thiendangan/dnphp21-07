<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'TrungKien',
            'email' => 'trungkien7300@gmail.com',
            'password' => bcrypt('trungkien98'),
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now()

        ]);
    }
}
