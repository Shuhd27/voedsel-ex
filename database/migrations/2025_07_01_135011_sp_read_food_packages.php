<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations: maak stored procedure `sp_read_food_packages`
     */
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_food_packages;
            CREATE PROCEDURE sp_read_food_packages()
            BEGIN
                SELECT 
                    fp.package_number,
                    fp.composition_date,
                    fp.distribution_date,
                    fp.status,
                    SUM(ppfp.quantity_product_units) AS total_quantity_product_units
                FROM 
                    food_packages fp
                Inner JOIN 
                    product_per_food_packages ppfp ON fp.id = ppfp.food_package_id
                WHERE 
                    fp.IsActive = 1
                GROUP BY 
                    fp.package_number,
                    fp.composition_date,
                    fp.distribution_date,
                    fp.status;
            END
        ');
    }

    /**
     * Reverse the migrations: verwijder procedure als hij bestaat
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_food_packages');
    }
};
