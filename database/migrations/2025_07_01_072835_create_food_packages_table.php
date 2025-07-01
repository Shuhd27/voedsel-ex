<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * voedselpakket table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS food_packages;
        CREATE TABLE food_packages (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            family_id INT UNSIGNED NOT NULL,
            package_number VARCHAR(50) NOT NULL UNIQUE,
            composition_date DATE NOT NULL,
            distribution_date DATE DEFAULT NULL,
            status ENUM("Uitgereikt", "NietUitgereikt", "NietMeerIngeschreven") NOT NULL DEFAULT "Uitgereikt",
            IsActive BIT NOT NULL DEFAULT 1,
            Note TEXT DEFAULT NULL,
            Created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            Updated_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (family_id) REFERENCES Family(id)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS food_packages');
        // Schema::dropIfExists('food_packages');
    }
};
