<?php

namespace Database\Seeders;

use App\Models\Profiluser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'id'=>'1',
                'nama_pj'=>'Mas/Mba AdPus',
                'alamat'=>'jalan raya salemba',
                'no_wa'=>'123456',
                'user_id'=>'1'
            ],
            [
                'id'=>'2',
                'nama_pj'=>'Mas/Mba Adwil',
                'alamat'=>'jalan raya salemba',
                'no_wa'=>'123456',
                'user_id'=>'2'
            ],
            [
                'id'=>'3',
                'nama_pj'=>'Mas/Mba AdPus2',
                'alamat'=>'jalan raya salemba',
                'no_wa'=>'123456',
                'user_id'=>'3'
            ]
            ];
        
        foreach ($data as $key => $value) {
            # code...
            Profiluser::create($value);
        }
    }
}
