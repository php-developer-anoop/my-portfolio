<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        DB::table('tbl_admin')->insert([
            'email' =>'myportfolio.in',
            'password' => md5('admin@myportfolio.in'),
            'created_at'=>date('Y-m-d H:i:s')          
        ]);
    }
}
