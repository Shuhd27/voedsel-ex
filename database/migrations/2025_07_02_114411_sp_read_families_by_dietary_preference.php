<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_families_by_dietary_preference;
            CREATE PROCEDURE sp_read_families_by_dietary_preference(IN preference VARCHAR(100))
            BEGIN
                SELECT
                    f.Id AS family_id,
                    f.name AS Gezinsnaam,
                    f.code,
                    f.description AS Omschrijving,
                    f.number_of_adults AS Volwassenen,
                    f.number_of_children AS Kinderen,
                    f.number_of_babies AS Babys,
                    f.total_number_of_people AS TotaalAantalPersonen,
                    CONCAT(REP.first_name, " ", IFNULL(REP.infix, ""), " ", REP.last_name) AS Vertegenwoordiger,
                    f.IsActive,
                    dp.name AS dietary_preference,
                    dpf.Note
                FROM families f
                INNER JOIN dietary_preference_per_families dpf
                    ON f.Id = dpf.family_id
                INNER JOIN dietary_preferences dp
                    ON dpf.dietary_preference_id = dp.Id
                WHERE dp.name = preference
                ORDER BY f.name ASC;
            END;
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_families_by_dietary_preference');
    }
};
