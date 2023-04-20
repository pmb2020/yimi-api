<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->truncate();
        $data1 = [
            [
                'path' => '/home1',
                'meta' => json_encode([
                    'title' => '首页',
                    'icon' => 'HomeFilled'
                ])
            ],
            [
                'path' => '/user',
                'meta' => json_encode([
                    'title' => '用户管理',
                    'icon' => 'HomeFilled'
                ])
            ],
            [
                'path' => '/account',
                'meta' => json_encode([
                    'title' => '账户管理',
                    'icon' => 'HomeFilled'
                ])
            ],
            [
                'path' => '/setting',
                'meta' => json_encode([
                    'title' => '系统设置',
                    'icon' => 'HomeFilled'
                ])
            ],

        ];

        $data2 = [
            [
                'p_id' => 1,
                'name' => 'home1',
                'path' => '/home1',
                'component' => 'home/index',
                'meta' => null
            ],
            [
                'p_id' => 2,
                'name' => 'user-index',
                'path' => 'index',
                'component' => 'user/index',
                'meta' => null
            ],
            [
                'p_id' => 3,
                'name' => 'account-index',
                'path' => 'role',
                'component' => 'account/index',
                'meta' => json_encode([
                    'title' => '账号列表',
                    'icon' => 'HomeFilled'
                ])
            ],
            [
                'p_id' => 3,
                'name' => 'account-role',
                'path' => 'role',
                'component' => 'role/index',
                'meta' => json_encode([
                    'title' => '角色管理',
                    'icon' => 'HomeFilled'
                ])
            ],
            [
                'p_id' => 3,
                'name' => 'account-menu',
                'path' => 'menu',
                'component' => 'menu/index',
                'meta' => json_encode([
                    'title' => '菜单管理',
                    'icon' => 'HomeFilled'
                ])
            ],
            [
                'p_id' => 4,
                'name' => 'setting',
                'path' => 'index',
                'component' => 'setting/index',
                'meta' => null
            ],
        ];
        DB::table('menus')->insert($data1);
        DB::table('menus')->insert($data2);
    }
}
