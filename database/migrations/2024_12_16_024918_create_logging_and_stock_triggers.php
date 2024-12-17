<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLoggingAndStockTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            -- Trigger untuk perubahan tabel customers
            CREATE TRIGGER after_customer_changes
            AFTER INSERT ON customers
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (user_id, action, affected_table, affected_id, affected_name, old_value, new_value, log_time)
                VALUES (
                    NEW.created_by, -- Ambil user_id dari kolom created_by
                    'insert',
                    'customers',
                    NEW.customer_id,
                    NEW.customer_name,
                    '',
                    JSON_OBJECT(
                        'customer_name', NEW.customer_name,
                        'customer_phone_number', NEW.customer_phone_number
                    ),
                    NOW()
                );
            END;
            ");

            DB::unprepared("
            -- Trigger untuk update customers
            CREATE TRIGGER after_customer_updates
            AFTER UPDATE ON customers
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (user_id, action, affected_table, affected_id, affected_name, old_value, new_value, log_time)
                VALUES (
                    1, -- Default ke user_id=1 karena tidak ada field updated_by
                    'update',
                    'customers',
                    NEW.customer_id,
                    NEW.customer_name,
                    JSON_OBJECT(
                        'customer_name', OLD.customer_name,
                        'customer_phone_number', OLD.customer_phone_number
                    ),
                    JSON_OBJECT(
                        'customer_name', NEW.customer_name,
                        'customer_phone_number', NEW.customer_phone_number
                    ),
                    NOW()
                );
            END;
            ");

            DB::unprepared("
            -- Trigger untuk perubahan tabel suppliers
            CREATE TRIGGER after_supplier_changes
            AFTER INSERT ON suppliers
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (user_id, action, affected_table, affected_id, affected_name, old_value, new_value, log_time)
                VALUES (
                    1, -- Default ke user_id=1 karena tidak ada field created_by
                    'insert',
                    'suppliers',
                    NULL,
                    NEW.name,
                    '',
                    JSON_OBJECT(
                        'name', NEW.name,
                        'contact_name', NEW.contact_name,
                        'phone', NEW.phone,
                        'address', NEW.address
                    ),
                    NOW()
                );
            END;
            ");

            DB::unprepared("
            -- Trigger untuk update suppliers
            CREATE TRIGGER after_supplier_updates
            AFTER UPDATE ON suppliers
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (user_id, action, affected_table, affected_id, affected_name, old_value, new_value, log_time)
                VALUES (
                    1, -- Default ke user_id=1 karena tidak ada field updated_by
                    'update',
                    'suppliers',
                    NULL,
                    NEW.name,
                    JSON_OBJECT(
                        'name', OLD.name,
                        'contact_name', OLD.contact_name,
                        'phone', OLD.phone,
                        'address', OLD.address
                    ),
                    JSON_OBJECT(
                        'name', NEW.name,
                        'contact_name', NEW.contact_name,
                        'phone', NEW.phone,
                        'address', NEW.address
                    ),
                    NOW()
                );
            END;
            ");

            DB::unprepared("
            -- Trigger untuk perubahan tabel services
            CREATE TRIGGER after_service_changes
            AFTER INSERT ON services
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (user_id, action, affected_table, affected_id, affected_name, old_value, new_value, log_time)
                VALUES (
                    1, -- Default ke user_id=1 karena tidak ada field created_by
                    'insert',
                    'services',
                    NEW.id_service,
                    '',
                    '',
                    JSON_OBJECT(
                        'service_name', NEW.service_name,
                        'service_price', NEW.service_price,
                        'stock', NEW.stock,
                        'supplier_id', NEW.supplier_id
                    ),
                    NOW()
                );
            END;
            ");

            DB::unprepared("
            -- Trigger untuk update services
            CREATE TRIGGER after_service_updates
            AFTER UPDATE ON services
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (user_id, action, affected_table, affected_id, affected_name, old_value, new_value, log_time)
                VALUES (
                    1, -- Default ke user_id=1 karena tidak ada field updated_by
                    'update',
                    'services',
                    NEW.id_service,
                    NEW.service_name,
                    JSON_OBJECT(
                        'service_name', OLD.service_name,
                        'service_price', OLD.service_price,
                        'stock', OLD.stock
                    ),
                    JSON_OBJECT(
                        'service_name', NEW.service_name,
                        'service_price', NEW.service_price,
                        'stock', NEW.stock
                    ),
                    NOW()
                );
            END;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS after_customer_changes;
            DROP TRIGGER IF EXISTS after_customer_updates;
            DROP TRIGGER IF EXISTS after_supplier_changes;
            DROP TRIGGER IF EXISTS after_supplier_updates;
            DROP TRIGGER IF EXISTS after_service_changes;
            DROP TRIGGER IF EXISTS after_service_updates;
        ');
    }
}