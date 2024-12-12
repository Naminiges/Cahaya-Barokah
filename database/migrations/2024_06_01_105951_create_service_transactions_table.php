<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_transactions', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->string('invoice_number')->unique();
            $table->date('entry_date')->nullable();
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('cashier_name');
            $table->string('customer_name');
            $table->json('service_ids')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_transactions');
    }
}
