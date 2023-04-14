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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('type')->unsigned()->default(0)->comment('0普通商品1虚拟商品');
            $table->tinyInteger('status')->default(0);
            $table->integer('category_id')->unsigned()->default(0);
            $table->text('description')->nullable()->comment('描述');
            $table->json('images')->nullable();
            $table->decimal('price',10,2)->default('0.00')->comment('价格');
            $table->integer('stock')->unsigned()->default(0)->comment('库存');
            $table->integer('sales_num')->unsigned()->default(0)->comment('销量');
            $table->string('unit',10)->comment('单位');
            $table->text('content')->nullable()->comment('详情');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
