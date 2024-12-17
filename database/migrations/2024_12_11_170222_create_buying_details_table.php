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
        Schema::create('buying_details', function (Blueprint $table) {
            $table->integer('buying_detail_id')->autoIncrement()->primary();
            $table->char('buying_invoice_id', 36);
            $table->foreign('buying_invoice_id')->references('buying_invoice_id')->on('buyings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name',255);
            $table->decimal('product_supplier_price',10,2);
            $table->timestamp('exp_date');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buying_details');
    }
};
