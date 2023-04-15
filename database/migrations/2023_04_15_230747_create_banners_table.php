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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('sort')->unsigned()->default(0);
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('image');
            $table->string('note')->nullable()->comment('备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
