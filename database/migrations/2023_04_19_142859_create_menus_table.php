<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->nullable()->comment('路由名称');
            $table->tinyInteger('status')->default(0);
            $table->integer('p_id')->default(0)->comment('父路由id');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('path',30)->comment('路径/开头');
            $table->string('component',30)->nullable()->comment('布局组件');
            $table->json('meta')->nullable()->comment('title,icon');
            $table->string('description')->nullable()->comment('备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
