<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * magazijn table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS warehouses;
        CREATE TABLE warehouses (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            receipt_date DATE NOT NULL,
            delivery_date DATE DEFAULT NULL,
            packaging_unit VARCHAR(50) NOT NULL,
            quantity INT UNSIGNED NOT NULL,
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
        DB::unprepared('DROP TABLE IF EXISTS warehouses');
        // Schema::dropIfExists('warehouses');
    }
};
