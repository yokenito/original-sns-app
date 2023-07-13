<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stamp_names = [
            '面白い', '感動'
        ];

        $count = 1;

        foreach($stamp_names as $stamp_name){
            DB::table('stamps')->insert([
                'stamp_status' => $count,
                'stamp_content' => $stamp_name,
            ]);
            $count++;
        }
    }
}
