<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_family_by_id;
            CREATE PROCEDURE sp_read_family_by_id(IN p_id INT)
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
                INNER JOIN dietary_preference_per_families DPF ON DPF.family_id = FAM.id AND DPF.IsActive = b\'1\'
                INNER JOIN dietary_preferences DP ON DP.id = DPF.dietary_preference_id AND DP.IsActive = b\'1\'
                INNER JOIN People REP ON REP.family_id = FAM.id AND REP.is_representative = b\'1\' AND REP.IsActive = b\'1\'
                WHERE FAM.IsActive = b\'1\' AND FAM.id = p_id
                GROUP BY FAM.id, FAM.name, FAM.number_of_adults, FAM.number_of_children, FAM.number_of_babies, REP.is_representative
                ORDER BY FAM.name ASC;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_family_by_id;');
    }
};
