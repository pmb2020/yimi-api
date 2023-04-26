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
//        DB::table('menus')->truncate();
        $data1 = [
            [
                'path' => '/',
                'title' => '首页',
                'icon' => 'HomeFilled',
            ],
            [
                'path' => '/banner',
                'title' => '轮播管理',
                'icon' => 'Picture',
            ],
            [
                'path' => '/user',
                'title' => '用户管理',
                'icon' => 'UserFilled',
            ],
            [
                'path' => '/account',
                'title' => '账户管理',
                'icon' => 'WalletFilled',
            ],
            [
                'path' => '/setting',
                'title' => '系统设置',
                'icon' => 'Setting',
            ],

        ];

        $data2 = [
            [
                'p_id' => 1,
                'name' => 'home',
                'path' => 'home',
                'component' => 'home/index',
                'title' => null,
                'icon' => null,
            ],
            [
                'p_id' => 2,
                'name' => 'banner-index',
                'path' => 'index',
                'component' => 'banner/index',
                'title' => null,
                'icon' => null,
            ],
            [
                'p_id' => 3,
                'name' => 'user-index',
                'path' => 'index',
                'component' => 'user/index',
                'title' => null,
                'icon' => null,
            ],
            [
                'p_id' => 4,
                'name' => 'account-index',
                'path' => 'index',
                'component' => 'account/index',
                'title' => '账号列表',
                'icon' => 'HomeFilled',
            ],
            [
                'p_id' => 4,
                'name' => 'account-role',
                'path' => 'role',
                'component' => 'role/index',
                'title' => '角色管理',
                'icon' => 'HomeFilled',
            ],
            [
                'p_id' => 4,
                'name' => 'account-menu',
                'path' => 'menu',
                'title' => '菜单管理',
                'icon' => 'HomeFilled',
                'component' => 'menu/index',
            ],
            [
                'p_id' => 5,
                'name' => 'setting',
                'path' => 'index',
                'component' => 'setting/index',
                'title' => null,
                'icon' => null,
            ],
        ];
        $data3 = [];
        DB::table('menus')->insert($data1);
        DB::table('menus')->insert($data2);

        DB::table('roles')->insert([
            'name' => '超级管理员',
//            'cn_name' => '超级管理员',
            'description' => '超级管理员具备系统所有权限'
        ]);

        DB::table('roles')->insert([
            'name' => 'test',
//            'cn_name' => '测试角色',
            'description' => ''
        ]);
        DB::table('roles')->insert([
            'name' => 'common',
//            'cn_name' => '普通角色',
            'description' => ''
        ]);

        DB::table('model_has_roles')->insert([
            'model_id' => 1,
            'model' => 'Admin',
            'role_id' => 1
        ]);

//        DB::table('model_has_roles')->insert([
//            'model_id' => 1,
//            'model' => 'Admin',
//            'role_id' => 2
//        ]);

        DB::table('role_has_menus')->insert([
            'role_id' => 2,
            'menu_id' => 1
        ]);
//        DB::table('role_has_menus')->insert([
//            'role_id' => 2,
//            'menu_id' => 2
//        ]);
//        DB::table('role_has_menus')->insert([
//            'role_id' => 2,
//            'menu_id' => 3
//        ]);
//        DB::table('role_has_menus')->insert([
//            'role_id' => 2,
//            'menu_id' => 4
//        ]);
//        DB::table('role_has_menus')->insert([
//            'role_id' => 2,
//            'menu_id' => 5
//        ]);
        DB::table('role_has_menus')->insert([
            'role_id' => 2,
            'menu_id' => 6
        ]);

    }
}
