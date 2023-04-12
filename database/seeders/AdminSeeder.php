<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'nickname' => '超级管理员',
            'password' => bcrypt('123456'),
            'register_ip' => Request::getClientIp()
        ]);

        DB::table('users')->insert([
            'phone' => '15567890908',
            'password' => bcrypt('123456'),
        ]);
    }
}
