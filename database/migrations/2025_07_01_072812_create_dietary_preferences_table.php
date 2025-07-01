<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     * Eetwens table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS dietary_preferences;
        CREATE TABLE dietary_preferences (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL UNIQUE,
            description TEXT DEFAULT NULL,
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
        DB::unprepared('DROP TABLE IF EXISTS dietary_preferences');
        // Schema::dropIfExists('dietary_preferences');
    }
};
