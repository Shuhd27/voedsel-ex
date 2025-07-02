<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS sp_read_families_by_dietary_preference;
        CREATE PROCEDURE sp_read_families_by_dietary_preference(IN _dietary_preference VARCHAR(100))
        BEGIN
            SELECT
                FAM.id,
                FAM.name AS Gezinsnaam,
                FAM.description AS Omschrijving,
                FAM.number_of_adults AS Volwassenen,
                FAM.number_of_children AS Kinderen,
                FAM.number_of_babies AS Babys,
                CONCAT(REP.first_name, " ", IFNULL(REP.infix, ""), " ", REP.last_name) AS Vertegenwoordiger,
                GROUP_CONCAT(DISTINCT DP.name SEPARATOR ", ") AS Dieetvoorkeuren
            FROM families FAM
            INNER JOIN dietary_preference_per_families DPF 
                ON FAM.id = DPF.family_id AND DPF.IsActive = b\'1\'
            INNER JOIN dietary_preferences DP 
                ON DPF.dietary_preference_id = DP.id AND DP.IsActive = b\'1\'
            INNER JOIN People REP 
                ON REP.family_id = FAM.id AND REP.is_representative = b\'1\' AND REP.IsActive = b\'1\'
            WHERE FAM.IsActive = b\'1\' AND FAM.receives_food_package = b\'1\'
            AND (_dietary_preference = "" OR DP.name = _dietary_preference)
            GROUP BY FAM.id, FAM.name, FAM.description, FAM.number_of_adults, FAM.number_of_children, FAM.number_of_babies, REP.first_name, REP.infix, REP.last_name
            ORDER BY FAM.name ASC;
        END
    ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_families_by_dietary_preference;');
    }
};
