<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * tak masukin username Admin
     * password gowes123
     * email ini opsional  admin@goweslur.com
     */
    public function run(): void
    {
        //nah disini masukin nya
        User::create([
            'name' => 'Admin',
            'password' => Hash::make('gowes123'),
            // 'email' => 'admin@goweslur.com',
        ]);
    }
}