<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id'=>'1',
                'nama_role' => 'Admin',
            
            ],
            [
                'id'=>'2',
                'nama_role' => 'Operator',
            
            ]
            ];
    
            foreach ($data as $key => $value) {
                # code...
                Role::create($value);
            }
    }
}
