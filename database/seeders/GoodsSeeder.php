<?php

namespace Database\Seeders;

use App\Models\Goods;
use http\Client\Curl\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Goods::factory()->count(5)
            ->create();
    }
}
