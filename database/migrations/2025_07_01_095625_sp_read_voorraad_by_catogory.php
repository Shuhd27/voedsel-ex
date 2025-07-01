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
        drop procedure if exists sp_read_voorraad_by_catogory;
        CREATE PROCEDURE sp_read_voorraad_by_catogory(
            in category_name varchar(100)
        )
        begin

        select
            
            WER.id as warehouse_id,
            PRO.Name as product_name,
            WER.quantity as quantity,
            CAT.Name as category,
            WER.Packaging_unit as packaging_unit,
            PRO.expiration_date as expiration_date,
            PPW.location as location

        from warehouses as WER

        inner join product_per_warehouses as PPW
            on WER.id = PPW.warehouse_id
        
        inner join products as PRO
            on PPW.product_id = PRO.id
        
        inner join categories as CAT
            on PRO.category_id = CAT.id


        where
            CAT.Name = category_name
        
        group by
            WER.id,
            PRO.Name,
            WER.quantity,
            WER.Packaging_unit,
            PRO.expiration_date,
            CAT.Name,
            PPW.location


            order by
            PRO.Name asc;


        

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
