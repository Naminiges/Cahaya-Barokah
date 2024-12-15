<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCalculateTotalFunction extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $function = "
        CREATE FUNCTION calculate_buying_total(buying_invoice_id_param VARCHAR(255)) 
        RETURNS DECIMAL(10,2)
        DETERMINISTIC
        BEGIN
            DECLARE total_amount DECIMAL(10,2);
            SELECT COALESCE(SUM(product_supplier_price * quantity), 0)
            INTO total_amount
            FROM buying_details
            WHERE buying_invoice_id = buying_invoice_id_param;
            RETURN total_amount;
        END;
        ";

        DB::unprepared($function);
    }

    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_buying_total');
    }
}