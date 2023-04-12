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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0)->comment('0正常1禁用');
            $table->string('username')->unique()->comment('用户名');
            $table->string('password')->comment('密码');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('email')->nullable();
            $table->string('tel')->nullable()->comment('手机号');
            $table->ipAddress('register_ip')->nullable();
            $table->ipAddress('login_ip')->nullable();
            $table->timestamp('login_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
