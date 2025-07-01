<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * persoons table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS People;
        CREATE TABLE People (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            family_id INT UNSIGNED NULL,
            first_name VARCHAR(100) NOT NULL,
            infix VARCHAR(50) DEFAULT NULL,
            last_name VARCHAR(100) NOT NULL,
            birth_date DATE NOT NULL,
            person_type ENUM("Manager", "Vrijwilliger", "Klant", "Medewerker") NOT NULL,
            is_representative BIT NOT NULL DEFAULT 0,
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
        DB::unprepared('DROP TABLE IF EXISTS People');
        // Schema::dropIfExists('people');
    }
};
