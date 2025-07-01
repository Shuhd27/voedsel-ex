<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * EetwensPerGezin
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS dietary_preference_per_families;
        CREATE TABLE dietary_preference_per_families (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            family_id INT UNSIGNED NOT NULL,
            dietary_preference_id INT UNSIGNED NOT NULL,
            IsActive BIT NOT NULL DEFAULT 1,
            Note TEXT DEFAULT NULL,
            Created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            Updated_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (family_id) REFERENCES Family(id),
            FOREIGN KEY (dietary_preference_id) REFERENCES dietary_preferences(id)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS dietary_preference_per_families');
        // Schema::dropIfExists('dietary_preference_per_families');
    }
};
