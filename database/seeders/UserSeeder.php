<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData=[
            [
                'id'=>'1',
                'email'=>'adminpus1',
                'username'=>'adminpus1',
                'password'=>bcrypt('12345678'),
                'role_id'=>'1',
                'remember_token' => Str::random(10)
            ],
            [
                'id'=>'2',
                'email'=>'adminpus2',
                'username'=>'adminwil1',
                'password'=>bcrypt('12345678'),
                'role_id'=>'2',
                'remember_token' => Str::random(10)
            ],
            [
                'id'=>'3',
                'email'=>'adminpus3',
                'username'=>'adminwil2',
                'password'=>bcrypt('12345678'),
                'role_id'=>'2',
                'remember_token' => Str::random(10)
            ],
            [
                'id'=>'4',
                'email'=>'adminpus4',
                'username'=>'adminpus2',
                'password'=>bcrypt('12345678'),
                'role_id'=>'1',
                'remember_token' => Str::random(10)
            ],
            [
                'id'=>'5',
                'email'=>'adminpus5',
                'username'=>'adminpus3',
                'password'=>bcrypt('12345678'),
                'role_id'=>'1',
                'remember_token' => Str::random(10)
            ],
            [
                'id'=>'6',
                'email'=>'adminpus6',
                'username'=>'adminwil3',
                'password'=>bcrypt('12345678'),
                'role_id'=>'2',
                'remember_token' => Str::random(10)
            ]
            ];
        
        foreach ($userData as $key => $value) {
            # code...
            User::create($value);
        }
    }
}
