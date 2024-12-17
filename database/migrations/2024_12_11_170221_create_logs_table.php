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
        Schema::create('logs', function (Blueprint $table) {
            $table->integer('log_id')->primary()->autoIncrement();
            $table->integer('user_id');
            $table->enum('action',['insert', 'update', 'delete']);
            $table->string('affected_table',255);
            $table->integer('affected_id')->nullable();
            $table->string('affected_name');
            $table->text('old_value');
            $table->text('new_value');
            $table->timestamp('log_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
