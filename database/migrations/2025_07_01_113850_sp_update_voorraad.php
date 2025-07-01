<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_update_voorraad;
            CREATE PROCEDURE sp_update_voorraad(
                IN INproduct_id INT,
                IN INlocation VARCHAR(100),
                IN INdelivery_date DATE,
                IN INquantity INT
            )
            BEGIN

                DECLARE sel_warehouse_id INT DEFAULT 0;
                DECLARE old_quantity INT DEFAULT 0;

                SELECT warehouse_id INTO sel_warehouse_id
                FROM product_per_warehouses
                WHERE product_id = INproduct_id
                LIMIT 1;

                SELECT quantity INTO old_quantity
                FROM warehouses
                WHERE id = sel_warehouse_id
                LIMIT 1;

                UPDATE product_per_warehouses
                SET location = INlocation
                WHERE product_id = INproduct_id;

                UPDATE warehouses
                SET quantity = (old_quantity - INquantity),
                    delivery_date = INdelivery_date
                WHERE id = sel_warehouse_id;              

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
