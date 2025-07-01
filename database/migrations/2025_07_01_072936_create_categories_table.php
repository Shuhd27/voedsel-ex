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
        DROP TABLE IF EXISTS categories;
        CREATE TABLE categories (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            description TEXT DEFAULT NULL,
            IsActive BIT NOT NULL DEFAULT 1,
            Note TEXT DEFAULT NULL,
            Created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            Updated_at DATETIME(6) NOT NULL DEFAULT NOW(6)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS categories');
        // Schema::dropIfExists('categories');
    }
};
