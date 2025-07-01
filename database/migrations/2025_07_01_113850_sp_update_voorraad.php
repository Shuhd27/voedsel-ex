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

                DECLARE warehouse_id INT;

                SELECT warehouse_id INTO warehouse_id
                FROM product_per_warehouses
                WHERE product_id = INproduct_id;

                UPDATE product_per_warehouses
                SET location = INlocation
                WHERE product_id = INproduct_id;

                UPDATE warehouses
                SET quantity = INquantity,
                    delivery_date = INdelivery_date
                WHERE id = warehouse_id;              

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
