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
        Schema::create('user_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('type')->default(0);
            $table->string('code')->nullable();
            $table->dateTime('code_expire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_updates');
    }
};
