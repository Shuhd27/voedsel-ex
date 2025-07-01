<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_read_families_by_dietary_preference;
            CREATE PROCEDURE sp_read_families_by_dietary_preference(
                IN _dietary_preference VARCHAR(100)
            )
            BEGIN
                SELECT
                    fam.id AS family_id,
                    fam.name AS family_name,
                    dp.name AS dietary_preference,
                    fam.number_of_adults,
                    fam.number_of_children,
                    fam.number_of_babies,
                    fam.Vertegenwoordiger
                FROM families fam
                INNER JOIN dietary_preference_per_families dpf ON fam.id = dpf.family_id
                INNER JOIN dietary_preferences dp ON dpf.dietary_preference_id = dp.id
                WHERE (_dietary_preference = "" OR dp.name = _dietary_preference)
                ORDER BY fam.name ASC;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_read_families_by_dietary_preference;');
    }
};