<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS sp_update_food_package_status;
        CREATE PROCEDURE sp_update_food_package_status(
            IN p_family_id INT,
            IN p_status ENUM("Uitgereikt", "NietUitgereikt"),
            IN p_distribution_date DATE
        )
        BEGIN
            UPDATE food_packages
            SET status = p_status,
                distribution_date = p_distribution_date,
                updated_at = NOW()
            WHERE family_id = p_family_id;
        END
    ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_update_food_package_status;');
    }
};
