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
                'nama_role' => 'Admin Pusat',
            
            ],
            [
                'id'=>'2',
                'nama_role' => 'Admin Wilayah',
            
            ],
            [
                'id'=>'3',
                'nama_role' => 'Juri PS',
            
            ],
            [
                'id'=>'4',
                'nama_role' => 'Juri PT',
            
            ]
            ];
    
            foreach ($data as $key => $value) {
                # code...
                Role::create($value);
            }
    }
}
