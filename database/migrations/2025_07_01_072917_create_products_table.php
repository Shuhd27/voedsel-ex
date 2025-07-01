<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * products table
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TABLE IF EXISTS products;
        CREATE TABLE products (
            Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            category_id INT UNSIGNED NOT NULL,
            name VARCHAR(150) NOT NULL,
            allergy_type VARCHAR(100) DEFAULT NULL,
            barcode VARCHAR(50) UNIQUE NOT NULL,
            expiration_date DATE NOT NULL,
            description TEXT DEFAULT NULL,
            status ENUM("OpVoorraad", "NietOpVoorraad", "NietLeverbaar", "OverHoudbaarheidsDatum") NOT NULL DEFAULT "OpVoorraad",
            created_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            updated_at DATETIME(6) NOT NULL DEFAULT NOW(6),
            FOREIGN KEY (category_id) REFERENCES categories(id)
    );
');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE IF EXISTS products');
        // Schema::dropIfExists('products');
    }
};
