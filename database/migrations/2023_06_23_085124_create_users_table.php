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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons');
            $table->foreignId('role_id')->constrained('roles');
            $table->string('username', 250);
            $table->string('email', 250);
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->boolean('isOnline')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
