<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ProductPerVoedselpakketten table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS product_per_food_packages;
        CREATE TABLE product_per_food_packages (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            food_package_id INT UNSIGNED NOT NULL,
            product_id INT UNSIGNED NOT NULL,
            quantity_product_units INT UNSIGNED NOT NULL, -- AantalProductEenheden
            created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            updated_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (food_package_id) REFERENCES food_packages(id),
            FOREIGN KEY (product_id) REFERENCES products(id)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS product_per_food_packages');
        // Schema::dropIfExists('product_per_food_packages');
    }
};
