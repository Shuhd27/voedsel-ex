<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * product per magazijn table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS product_per_warehouses;
        CREATE TABLE product_per_warehouses (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            product_id INT UNSIGNED NOT NULL,
            warehouse_id INT UNSIGNED NOT NULL,
            location VARCHAR(100) DEFAULT NULL,
            IsActive BIT NOT NULL DEFAULT 1,
            Note TEXT DEFAULT NULL,
            Created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            Updated_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (product_id) REFERENCES products(id),
            FOREIGN KEY (warehouse_id) REFERENCES warehouses(id)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS product_per_warehouses');
        // Schema::dropIfExists('product_per_warehouses');
    }
};
