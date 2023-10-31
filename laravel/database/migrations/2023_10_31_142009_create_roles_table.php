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
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign("role_id")->references("id")->on("roles")->onUpdate("cascade")->onDelete("set null");
        });

        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true
         ]);

         Artisan::call('db:seed', [
            '--class' => 'UserSeeder',
            '--force' => true
         ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('roles');
    }
};
