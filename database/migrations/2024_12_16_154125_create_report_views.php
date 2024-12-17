<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateReportViews extends Migration
{
    public function up()
    {
        DB::unprepared("
            -- View vw_financial_report
            CREATE OR REPLACE VIEW vw_financial_report AS
            SELECT 
                transaction_date,
                SUM(total_sales_transactions) AS total_sales_transactions,
                SUM(total_purchase_transactions) AS total_purchase_transactions,
                SUM(total_sales_amount) AS total_sales_amount,
                SUM(total_purchase_amount) AS total_purchase_amount,
                SUM(total_sales_amount - total_purchase_amount) AS profit
            FROM (
                -- Sales Transactions
                SELECT 
                    s.entry_date AS transaction_date,
                    COUNT(DISTINCT s.invoice_number) AS total_sales_transactions,
                    0 AS total_purchase_transactions,
                    COALESCE(calculate_total_sales(s.entry_date, s.entry_date), 0) AS total_sales_amount,
                    0 AS total_purchase_amount
                FROM service_transactions s
                WHERE s.status = 'completed'
                GROUP BY s.entry_date

                UNION ALL

                -- Purchase Transactions
                SELECT 
                    b.order_date AS transaction_date,
                    0 AS total_sales_transactions,
                    COUNT(DISTINCT b.buying_invoice_id) AS total_purchase_transactions,
                    0 AS total_sales_amount,
                    COALESCE(calculate_total_purchases(b.order_date, b.order_date), 0) AS total_purchase_amount
                FROM buyings b
                GROUP BY b.order_date
            ) combined_data
            GROUP BY transaction_date
            ORDER BY transaction_date;
        ");

        DB::unprepared("
        CREATE PROCEDURE AddStock(IN productName VARCHAR(255), IN quantity INT)
        BEGIN
            -- Tambahkan stok ke service berdasarkan product_name
            UPDATE services
            SET stock = stock + quantity
            WHERE service_name = productName;
        END;
        ");

        DB::unprepared("
        CREATE PROCEDURE SubtractStock(IN serviceId INT, IN quantity INT)
        BEGIN
            -- Kurangi stok dari service berdasarkan id_service
            UPDATE services
            SET stock = stock - quantity
            WHERE id_service = serviceId AND stock >= quantity;

            -- Jika stok tidak mencukupi, tampilkan error
            IF ROW_COUNT() = 0 THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Stok tidak mencukupi untuk layanan ini.';
            END IF;
        END;
        ");

    }

    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS vw_financial_report');
    }
}