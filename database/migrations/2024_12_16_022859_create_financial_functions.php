<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFinancialFunctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            -- Function to calculate total sales within date range
            CREATE FUNCTION calculate_total_sales(start_date DATE, end_date DATE) 
            RETURNS DECIMAL(10,2)
            DETERMINISTIC
            BEGIN
                DECLARE total_amount DECIMAL(10,2);
                
                SELECT COALESCE(SUM(total_price), 0)
                INTO total_amount
                FROM service_transactions
                WHERE entry_date BETWEEN start_date AND end_date
                AND status = "completed";
                
                RETURN total_amount;
            END;
            ');

            DB::unprepared('
            -- Function to calculate total purchases within date range
            CREATE FUNCTION calculate_total_purchases(start_date DATE, end_date DATE)
            RETURNS DECIMAL(10,2)
            DETERMINISTIC
            BEGIN
                DECLARE total_amount DECIMAL(10,2);

                SELECT COALESCE(SUM(bd.product_supplier_price * bd.quantity), 0)
                INTO total_amount
                FROM buying_details bd
                JOIN buyings b ON bd.buying_invoice_id = b.buying_invoice_id
                WHERE DATE(b.order_date) BETWEEN start_date AND end_date
                AND b.order_date IS NOT NULL; -- Memastikan kolom order_date tidak NULL

                RETURN total_amount;
            END;
            ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
            DROP FUNCTION IF EXISTS calculate_total_sales;
            DROP FUNCTION IF EXISTS calculate_total_purchases;
        ');
    }
}