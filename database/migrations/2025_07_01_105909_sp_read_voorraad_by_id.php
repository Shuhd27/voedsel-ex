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
        drop procedure if exists sp_read_voorraad_by_id;
        CREATE PROCEDURE sp_read_voorraad_by_id(
            in product_id int
            )
            begin
            
            select
                PRO.Id as product_id,
                WER.id as warehouse_id,
                PRO.Name as product_name,
                PRO.Barcode as barcode,
                WER.delivery_date as delivery_date,
                WER.receipt_date as receipt_date,
                WER.quantity as quantity,
                PPW.location as location

                from products as PRO

                inner join product_per_warehouses as PPW
                    on PRO.id = PPW.product_id

                inner join warehouses as WER
                    on PPW.warehouse_id = WER.id

                where PRO.id = product_id
                
                limit 1;

                end
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
