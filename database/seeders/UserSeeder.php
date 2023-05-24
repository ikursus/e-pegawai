<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User 1 - Cara simpan data kaedah Model - New Object
        $user1 = new \App\Models\User;
        $user1->nama = 'Ali';
        $user1->email = 'ali@gmail.com';
        $user1->password = bcrypt('pass123'); // Atau Hash::make('pass123');
        $user1->status = 'active';
        $user1->role = 'admin';
        $user1->save();

        // User 2 - Cara simpan data Kaedah Model - create
        $user2 = User::create([
            'nama' => 'Abu',
            'email' => 'abu@gmail.com',
            'password' => bcrypt('pass123'),
            'role' => 'user',
            'status' => 'active'
        ]);

        // User 3 - Cara simpan data Kaedah Query Builder
        $user3 = DB::table('users')->insert([
            'nama' => 'Upin',
            'email' => 'upin@gmail.com',
            'password' => bcrypt('pass123'),
            'role' => 'admin',
            'status' => 'active'
        ]);

    }
}
