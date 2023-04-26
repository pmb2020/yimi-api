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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
//            $table->string('cn_name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->bigInteger('model_id')->unsigned();
            $table->string('model');
            $table->bigInteger('role_id')->unsigned();

            $table->foreign('model_id')->references('id')->on('admins')
                ->onDelete('cascade')->onUpdate('NO ACTION');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')->onUpdate('NO ACTION');

        });

        Schema::create('role_has_menus', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('menu_id')->unsigned();
            $table->unique(['role_id','menu_id']);

            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')->onUpdate('NO ACTION');

            $table->foreign('menu_id')->references('id')->on('menus')
                ->onDelete('cascade')->onUpdate('NO ACTION');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_role__menu__permission');
    }
};
