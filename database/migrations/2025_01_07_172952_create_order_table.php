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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('delegate_id')->nullable();
            $table->string('order_num');
            $table->decimal('lat',20,18);
            $table->decimal('lng',20,18);
            $table->string('map_desc');
            $table->string('title');
            $table->decimal('price');
            $table->integer('vat_per')->nullable();
            $table->decimal('vat_amount')->nullable();
            $table->decimal('delivery_price');
            $table->decimal('total_price');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('pay_type');
            $table->tinyInteger('pay_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
