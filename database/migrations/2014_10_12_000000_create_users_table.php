<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('company_name', 60)->nullable();
            $table->string('ic', 8)->nullable();
            $table->string('dic', 12)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('building_number', 10)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('zip', 7)->nullable();
            $table->string('country', 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
