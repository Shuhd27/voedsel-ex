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
            DROP PROCEDURE IF EXISTS sp_update_Family;
            CREATE PROCEDURE sp_update_Family(
                IN p_id INT,
                IN p_name VARCHAR(255),
                IN p_description TEXT,
                IN p_number_of_adults INT,
                IN p_number_of_children INT,
                IN p_number_of_babies INT,
                IN p_receives_food_package BOOLEAN
            )
            BEGIN
                UPDATE families
                SET
                    name = p_name,
                    description = p_description,
                    number_of_adults = p_number_of_adults,
                    number_of_children = p_number_of_children,
                    number_of_babies = p_number_of_babies,
                    receives_food_package = p_receives_food_package,
                    updated_at = NOW()
                WHERE id = p_id AND IsActive = b\'1\';
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_update_Family;');
    }
};
