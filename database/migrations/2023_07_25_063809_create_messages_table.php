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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained('channels');
            $table->foreignId('direct_id')->nullable()->constrained('directs');
            $table->foreignId('group_direct_id')->nullable()->constrained('group_directs');
            $table->foreignId('member_id')->constrained('users');
            $table->text('message');
            $table->boolean('isNotice')->default(0);
            $table->boolean('isPinned')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
