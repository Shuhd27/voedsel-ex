<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // sp voor dropdown menu van dieetvoorkeuren
        // Deze procedure haalt alle actieve dieetvoorkeuren op, gesorteerd op naam
        DB::unprepared('
        CREATE PROCEDURE sp_get_dietary_preferences()
        BEGIN
            SELECT GeenVarken AS name
            UNION
            SELECT Veganistisch
            UNION
            SELECT Vegetarisch
            UNION
            SELECT Omnivoor;
        END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_get_dietary_preferences;');
    }
};
