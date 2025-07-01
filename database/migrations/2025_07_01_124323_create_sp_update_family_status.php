<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS sp_update_Family;
            CREATE PROCEDURE sp_update_Family(IN p_family_id INT, IN p_status VARCHAR(50), IN p_distribution_date DATE)
            BEGIN
                DECLARE food_package_id INT;
                
                -- Check if food package exists for this family
                SELECT Id INTO food_package_id 
                FROM food_packages 
                WHERE family_id = p_family_id 
                ORDER BY Created_at DESC 
                LIMIT 1;
                
                IF food_package_id IS NOT NULL THEN
                    -- Update existing food package
                    UPDATE food_packages 
                    SET status = p_status, 
                        distribution_date = p_distribution_date,
                        Updated_at = NOW(6)
                    WHERE Id = food_package_id;
                ELSE
                    -- Create new food package if none exists
                    INSERT INTO food_packages (family_id, package_number, composition_date, distribution_date, status, Created_at, Updated_at)
                    VALUES (p_family_id, CONCAT("PKG-", p_family_id, "-", UNIX_TIMESTAMP()), CURDATE(), p_distribution_date, p_status, NOW(6), NOW(6));
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_update_Family;');
    }
};
