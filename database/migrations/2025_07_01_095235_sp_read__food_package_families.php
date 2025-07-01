<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_FoodPackageFamilies;
            CREATE PROCEDURE sp_read_FoodPackageFamilies()
            BEGIN
                SELECT 
                    FAM.id,
                    FAM.name AS Gezinsnaam,
                    FAM.description AS Omschrijving,
                    FAM.number_of_adults AS Volwassenen,
                    FAM.number_of_children AS Kinderen,
                    FAM.number_of_babies AS Babys,
                    CONCAT(REP.first_name, " ", COALESCE(REP.infix, ""), " ", REP.last_name) AS Vertegenwoordiger
                FROM families AS FAM
                LEFT JOIN people AS REP
                    ON REP.family_id = FAM.id AND REP.is_representative = 1
                WHERE FAM.IsActive = 1
                  AND FAM.receives_food_package = 1;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_FoodPackageFamilies');
    }
};
