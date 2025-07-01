<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * families table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS families;
        CREATE TABLE families (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(150) NOT NULL UNIQUE,
            code VARCHAR(50) DEFAULT NULL,
            description TEXT DEFAULT NULL,
            number_of_adults TINYINT UNSIGNED NOT NULL,
            number_of_children TINYINT UNSIGNED NOT NULL,
            number_of_babies TINYINT UNSIGNED NOT NULL,
            total_number_of_people TINYINT UNSIGNED AS (number_of_adults + number_of_children + number_of_babies) STORED,
            is_active BIT NOT NULL DEFAULT 1,
            created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            updated_at DATETIME(6) NOT NULL DEFAULT NOW(6)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS families');
        // Schema::dropIfExists('families');
    }
};
