<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_PeopleFamilies;
            CREATE PROCEDURE sp_read_PeopleFamilies()
            BEGIN
                SELECT
                    FAM.id,
                    FAM.name AS Gezinsnaam,
                    FAM.description AS Omschrijving,
                    FAM.number_of_adults AS Volwassenen,
                    FAM.number_of_children AS Kinderen,
                    FAM.number_of_babies AS Babys,
                    REP.is_representative AS Vertegenwoordiger,
                    GROUP_CONCAT(DISTINCT CONCAT(DP.name, ": ", DP.description) SEPARATOR " | ") AS Voedselpakket_Details
                FROM families AS FAM
                inner join dietary_preference_per_families DPF ON DPF.family_id = FAM.id AND DPF.IsActive = b\'1\'
                inner join dietary_preferences DP ON DP.id = DPF.dietary_preference_id AND DP.IsActive = b\'1\'
                inner join People REP ON REP.family_id = FAM.id AND REP.is_representative = b\'1\' AND REP.IsActive = b\'1\'
                WHERE FAM.IsActive = b\'1\' AND FAM.receives_food_package = b\'1\'
                GROUP BY FAM.id, FAM.name, FAM.number_of_adults, FAM.number_of_children, FAM.number_of_babies, REP.first_name, REP.infix, REP.last_name
                ORDER BY FAM.name ASC;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_PeopleFamilies;');
    }
};
