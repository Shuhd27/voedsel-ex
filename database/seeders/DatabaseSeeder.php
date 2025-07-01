<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // families aanmaken
        $familyIds = [];
        $families = [
            ['name' => 'ZevenhuizenGezin', 'code' => 'G0001', 'description' => 'Bijstandsgezin', 'number_of_adults' => 2, 'number_of_children' => 2, 'number_of_babies' => 0, 'total_number_of_people' => 4],
            ['name' => 'BergkampGezin',   'code' => 'G0002', 'description' => 'Bijstandsgezin', 'number_of_adults' => 2, 'number_of_children' => 1, 'number_of_babies' => 1, 'total_number_of_people' => 4],
            ['name' => 'HeuvelGezin',     'code' => 'G0003', 'description' => 'Bijstandsgezin', 'number_of_adults' => 2, 'number_of_children' => 0, 'number_of_babies' => 0, 'total_number_of_people' => 2],
            ['name' => 'ScherderGezin',   'code' => 'G0004', 'description' => 'Bijstandsgezin', 'number_of_adults' => 1, 'number_of_children' => 0, 'number_of_babies' => 2, 'total_number_of_people' => 3],
            ['name' => 'DeJongGezin',     'code' => 'G0005', 'description' => 'Bijstandsgezin', 'number_of_adults' => 1, 'number_of_children' => 1, 'number_of_babies' => 0, 'total_number_of_people' => 2],
            ['name' => 'VanderBergGezin', 'code' => 'G0006', 'description' => 'AlleenGaande',  'number_of_adults' => 1, 'number_of_children' => 0, 'number_of_babies' => 0, 'total_number_of_people' => 1],
        ];
        foreach ($families as $family) {
            $familyIds[] = DB::table('Families')->insertGetId(array_merge($family, [
                'IsActive' => 1,
                'Created_at' => now(),
                'Updated_at' => now(),
            ]));
        }

        // Personen aanmaken
        $personIds = [];
        $people = [
            ['family_id' => null, 'first_name' => 'Hans',    'infix' => 'van',     'last_name' => 'Leeuwen',    'birth_date' => '1958-02-12', 'person_type' => 'Manager',     'is_representative' => 0],
            ['family_id' => null, 'first_name' => 'Jan',     'infix' => 'van der', 'last_name' => 'Sluijs',     'birth_date' => '1993-04-30', 'person_type' => 'Medewerker',  'is_representative' => 0],
            ['family_id' => null, 'first_name' => 'Herman',  'infix' => 'den',     'last_name' => 'Duiker',     'birth_date' => '1989-08-30', 'person_type' => 'Vrijwilliger', 'is_representative' => 0],
            ['family_id' => 1,    'first_name' => 'Johan',   'infix' => 'van',     'last_name' => 'Zevenhuizen', 'birth_date' => '1990-05-20', 'person_type' => 'Klant',       'is_representative' => 1],
            ['family_id' => 1,    'first_name' => 'Sarah',   'infix' => 'den',     'last_name' => 'Dolder',     'birth_date' => '1985-03-23', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 1,    'first_name' => 'Theo',    'infix' => 'van',     'last_name' => 'Zevenhuizen', 'birth_date' => '2015-03-08', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 1,    'first_name' => 'Jantien', 'infix' => 'van',     'last_name' => 'Zevenhuizen', 'birth_date' => '2016-09-20', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 2,    'first_name' => 'Arjan',   'infix' => null,       'last_name' => 'Bergkamp',   'birth_date' => '1968-07-12', 'person_type' => 'Klant',       'is_representative' => 1],
            ['family_id' => 2,    'first_name' => 'Janneke', 'infix' => null,       'last_name' => 'Sanders',    'birth_date' => '1969-05-11', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 2,    'first_name' => 'Stein',   'infix' => null,       'last_name' => 'Bergkamp',   'birth_date' => '2009-02-02', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 2,    'first_name' => 'Judith',  'infix' => null,       'last_name' => 'Bergkamp',   'birth_date' => '2022-02-05', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 3,    'first_name' => 'Mazin',   'infix' => 'van',     'last_name' => 'Vliet',      'birth_date' => '1968-08-18', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 3,    'first_name' => 'Selma',   'infix' => 'van de',  'last_name' => 'Heuvel',     'birth_date' => '1965-09-04', 'person_type' => 'Klant',       'is_representative' => 1],
            ['family_id' => 4,    'first_name' => 'Eva',     'infix' => null,       'last_name' => 'Scherder',   'birth_date' => '2000-04-07', 'person_type' => 'Klant',       'is_representative' => 1],
            ['family_id' => 4,    'first_name' => 'Felicia', 'infix' => null,       'last_name' => 'Scherder',   'birth_date' => '2021-11-29', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 4,    'first_name' => 'Devin',   'infix' => null,       'last_name' => 'Scherder',   'birth_date' => '2024-03-01', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 5,    'first_name' => 'Frieda',  'infix' => 'de',      'last_name' => 'Jong',       'birth_date' => '1980-09-04', 'person_type' => 'Klant',       'is_representative' => 1],
            ['family_id' => 5,    'first_name' => 'Simeon',  'infix' => 'de',      'last_name' => 'Jong',       'birth_date' => '2018-05-23', 'person_type' => 'Klant',       'is_representative' => 0],
            ['family_id' => 6,    'first_name' => 'Hanna',   'infix' => 'van der', 'last_name' => 'Berg',       'birth_date' => '1999-09-09', 'person_type' => 'Klant',       'is_representative' => 1],
        ];
        foreach ($people as $person) {
            $personIds[] = DB::table('People')->insertGetId(array_merge($person, [
                'IsActive' => 1,
                'Created_at' => now(),
                'Updated_at' => now(),
            ]));
        }

        // dietary_preference_per_families / EetwensPerGezin aanmaken
        $dietaryPreferencePerFamilyIds = [];
        $dietaryPreferencePerFamilies = [
            ['family_id' => 1, 'dietary_preference_id' => 2],
            ['family_id' => 2, 'dietary_preference_id' => 4],
            ['family_id' => 3, 'dietary_preference_id' => 4],
            ['family_id' => 4, 'dietary_preference_id' => 3],
            ['family_id' => 5, 'dietary_preference_id' => 2],
        ];
        foreach ($dietaryPreferencePerFamilies as $preference) {
            $dietaryPreferencePerFamilyIds[] = DB::table('dietary_preference_per_families')->insertGetId(array_merge($preference, [
                'IsActive' => 1,
                'Created_at' => now(),
                'Updated_at' => now(),
            ]));
        }

        // dietary_preferences / eetwens aanmaken
        $dietaryPreferenceIds = [];
        $dietaryPreferences = [
            ['name' => 'GeenVarken', 'description' => 'Geen Varkensvlees'],
            ['name' => 'Veganistisch', 'description' => 'Geen zuivelproducten en vlees'],
            ['name' => 'Vegetarisch', 'description' => 'Geen vlees'],
            ['name' => 'Omnivoor', 'description' => 'Geen beperkingen'],
        ];
        foreach ($dietaryPreferences as $preference) {
            $dietaryPreferenceIds[] = DB::table('Dietary_Preferences')->insertGetId(array_merge($preference, [
                'IsActive' => 1,
                'Created_at' => now(),
                'Updated_at' => now(),
            ]));
        }

        // food_packages / voedselpakketten aanmaken
        $foodPackageIds = [];
        $foodPackages = [
            ['family_id' => 1, 'package_number' => '1', 'composition_date' => '2024-04-06', 'distribution_date' => '2024-04-07', 'status' => 'Uitgereikt'],
            ['family_id' => 1, 'package_number' => '2', 'composition_date' => '2024-04-13', 'distribution_date' => NULL, 'status' => 'NietUitgereikt'],
            ['family_id' => 1, 'package_number' => '3', 'composition_date' => '2024-04-20', 'distribution_date' => NULL, 'status' => 'NietMeerIngeschreven'],
            ['family_id' => 2, 'package_number' => '4', 'composition_date' => '2024-04-06', 'distribution_date' => '2024-04-07', 'status' => 'Uitgereikt'],
            ['family_id' => 2, 'package_number' => '5', 'composition_date' => '2024-04-13', 'distribution_date' => '2024-04-14', 'status' => 'Uitgereikt'],
            ['family_id' => 2, 'package_number' => '6', 'composition_date' => '2024-04-20', 'distribution_date' => NULL, 'status' => 'NietUitgereikt'],
        ];
        foreach ($foodPackages as $package) {
            $foodPackageIds[] = DB::table('Food_Packages')->insertGetId(array_merge($package, [
                'IsActive' => 1,
                'Created_at' => now(),
                'Updated_at' => now(),
            ]));
        }

        // product_per_food_packages / product_per_voedselpakketten aanmaken
        $productPerFoodPackageIds = [];
        $productPerFoodPackages = [
            ['food_package_id' => 1,  'product_id' => 7,  'quantity_product_units' => 1],
            ['food_package_id' => 1,  'product_id' => 8,  'quantity_product_units' => 2],
            ['food_package_id' => 1,  'product_id' => 9,  'quantity_product_units' => 1],
            ['food_package_id' => 2,  'product_id' => 12, 'quantity_product_units' => 1],
            ['food_package_id' => 2,  'product_id' => 13, 'quantity_product_units' => 2],
            ['food_package_id' => 2,  'product_id' => 14, 'quantity_product_units' => 1],
            ['food_package_id' => 3,  'product_id' => 3,  'quantity_product_units' => 1],
            ['food_package_id' => 3,  'product_id' => 4,  'quantity_product_units' => 1],
            ['food_package_id' => 4,  'product_id' => 20, 'quantity_product_units' => 1],
            ['food_package_id' => 4,  'product_id' => 19, 'quantity_product_units' => 1],
            ['food_package_id' => 4,  'product_id' => 21, 'quantity_product_units' => 1],
            ['food_package_id' => 5,  'product_id' => 24, 'quantity_product_units' => 1],
            ['food_package_id' => 5,  'product_id' => 25, 'quantity_product_units' => 1],
            ['food_package_id' => 5,  'product_id' => 26, 'quantity_product_units' => 1],
            ['food_package_id' => 6,  'product_id' => 26, 'quantity_product_units' => 1],
        ];
        foreach ($productPerFoodPackages as $productPerFoodPackage) {
            $productPerFoodPackageIds[] = DB::table('Product_Per_Food_Packages')->insertGetId(array_merge($productPerFoodPackage, [
                'IsActive' => 1,
                'Created_at' => now(),
                'Updated_at' => now(),
            ]));


            // Products aanmaken
            $productIds = [];
            $products = [
                ['category_id' => '1', 'name' => 'Aardappel', 'allergy_type' => null, 'barcode' => '8719587321239', 'expiration_date' => '2024-07-12', 'description' => 'Kruimige aardappel', 'status' => 'OpVoorraad'],
                ['category_id' => '1', 'name' => 'Aardappel', 'allergy_type' => null, 'barcode' => '8719587321239', 'expiration_date' => '2024-07-26', 'description' => 'Kruimige aardappel', 'status' => 'OpVoorraad'],
                ['category_id' => '1', 'name' => 'Ui', 'allergy_type' => null, 'barcode' => '8719437321335', 'expiration_date' => '2024-09-02', 'description' => 'Gele ui', 'status' => 'NietOpVoorraad'],
                ['category_id' => '1', 'name' => 'Appel', 'allergy_type' => null, 'barcode' => '8719486321332', 'expiration_date' => '2024-08-16', 'description' => 'Granny Smith', 'status' => 'NietLeverbaar'],
                ['category_id' => '1', 'name' => 'Appel', 'allergy_type' => null, 'barcode' => '8719486321332', 'expiration_date' => '2024-09-23', 'description' => 'Granny Smith', 'status' => 'NietLeverbaar'],
                ['category_id' => '1', 'name' => 'Banaan', 'allergy_type' => 'Banaan', 'barcode' => '8719484321336', 'expiration_date' => '2024-07-12', 'description' => 'Biologische Banaan', 'status' => 'OverHoudbaarheidsDatum'],
                ['category_id' => '1', 'name' => 'Banaan', 'allergy_type' => 'Banaan', 'barcode' => '8719484321336', 'expiration_date' => '2024-07-19', 'description' => 'Biologische Banaan', 'status' => 'OverHoudbaarheidsDatum'],
                ['category_id' => '2', 'name' => 'Kaas', 'allergy_type' => 'Lactose', 'barcode' => '8719487421338', 'expiration_date' => '2024-09-19', 'description' => 'Jonge Kaas', 'status' => 'OpVoorraad'],
                ['category_id' => '2', 'name' => 'Rosbief', 'allergy_type' => null, 'barcode' => '8719487421331', 'expiration_date' => '2024-07-23', 'description' => 'Rundvlees', 'status' => 'OpVoorraad'],
                ['category_id' => '3', 'name' => 'Melk', 'allergy_type' => 'Lactose', 'barcode' => '8719447321332', 'expiration_date' => '2024-07-23', 'description' => 'Halfvolle melk', 'status' => 'OpVoorraad'],
                ['category_id' => '3', 'name' => 'Margarine', 'allergy_type' => null, 'barcode' => '8719486321336', 'expiration_date' => '2024-08-02', 'description' => 'Plantaardige boter', 'status' => 'OpVoorraad'],
                ['category_id' => '3', 'name' => 'Ei', 'allergy_type' => 'Eier', 'barcode' => '8719487421334', 'expiration_date' => '2024-08-04', 'description' => 'Scharrelei', 'status' => 'OpVoorraad'],
                ['category_id' => '4', 'name' => 'Brood', 'allergy_type' => 'Gluten', 'barcode' => '8719487721337', 'expiration_date' => '2024-07-07', 'description' => 'Volkoren brood', 'status' => 'OpVoorraad'],
                ['category_id' => '4', 'name' => 'Gevulde Koek', 'allergy_type' => 'Amandel', 'barcode' => '8719483321333', 'expiration_date' => '2024-09-04', 'description' => 'Banketbakkers kwaliteit', 'status' => 'OpVoorraad'],
                ['category_id' => '5', 'name' => 'Fristi', 'allergy_type' => 'Lactose', 'barcode' => '8719487121331', 'expiration_date' => '2024-10-28', 'description' => 'Frisdrank', 'status' => 'NietOpVoorraad'],
                ['category_id' => '5', 'name' => 'Appelsap', 'allergy_type' => null, 'barcode' => '8719487521335', 'expiration_date' => '2024-10-19', 'description' => '100% vruchtensap', 'status' => 'OpVoorraad'],
                ['category_id' => '5', 'name' => 'Koffie', 'allergy_type' => 'Caffeïne', 'barcode' => '8719487381338', 'expiration_date' => '2024-10-23', 'description' => 'Arabica koffie', 'status' => 'OverHoudbaarheidsDatum'],
                ['category_id' => '5', 'name' => 'Thee', 'allergy_type' => 'Theïne', 'barcode' => '8719487329339', 'expiration_date' => '2024-09-02', 'description' => 'Ceylon thee', 'status' => 'OpVoorraad'],
                ['category_id' => '6', 'name' => 'Pasta', 'allergy_type' => 'Gluten', 'barcode' => '8719487321334', 'expiration_date' => '2024-12-16', 'description' => 'Macaroni', 'status' => 'NietLeverbaar'],
                ['category_id' => '6', 'name' => 'Rijst', 'allergy_type' => null, 'barcode' => '8719487331332', 'expiration_date' => '2024-12-25', 'description' => 'Basmati Rijst', 'status' => 'OpVoorraad'],
                ['category_id' => '6', 'name' => 'Knorr Nasi Mix', 'allergy_type' => null, 'barcode' => '871948735135', 'expiration_date' => '2024-12-13', 'description' => 'Nasi kruiden', 'status' => 'OpVoorraad'],
                ['category_id' => '7', 'name' => 'Tomatensoep', 'allergy_type' => null, 'barcode' => '8719487371337', 'expiration_date' => '2024-12-23', 'description' => 'Romige tomatensoep', 'status' => 'OpVoorraad'],
                ['category_id' => '7', 'name' => 'Tomatensaus', 'allergy_type' => null, 'barcode' => '8719487341334', 'expiration_date' => '2024-12-21', 'description' => 'Pizza saus', 'status' => 'NietOpVoorraad'],
                ['category_id' => '7', 'name' => 'Peterselie', 'allergy_type' => null, 'barcode' => '8719487321636', 'expiration_date' => '2024-07-31', 'description' => 'Verse kruidenpot', 'status' => 'OpVoorraad'],  // corrected 'OpVoorraaad' typo
                ['category_id' => '8', 'name' => 'Olie', 'allergy_type' => null, 'barcode' => '8719487327337', 'expiration_date' => '2024-12-27', 'description' => 'Olijfolie', 'status' => 'OpVoorraad'],
                ['category_id' => '8', 'name' => 'Mars', 'allergy_type' => null, 'barcode' => '8719487324334', 'expiration_date' => '2024-12-11', 'description' => 'Snoep', 'status' => 'OpVoorraad'],
                ['category_id' => '8', 'name' => 'Biscuit', 'allergy_type' => null, 'barcode' => '8719487311331', 'expiration_date' => '2024-08-07', 'description' => 'San Francisco biscuit', 'status' => 'OpVoorraad'],
                ['category_id' => '8', 'name' => 'Paprika Chips', 'allergy_type' => null, 'barcode' => '87194873218398', 'expiration_date' => '2024-12-22', 'description' => 'Ribbelchips paprika', 'status' => 'OpVoorraad'],
                ['category_id' => '8', 'name' => 'Chocolade reep', 'allergy_type' => 'Cacoa', 'barcode' => '8719487321533', 'expiration_date' => '2024-11-21', 'description' => 'Tony Chocolonely', 'status' => 'OpVoorraad'],
            ];

            foreach ($products as $product) {
                $productIds[] = DB::table('Products')->insertGetId(array_merge($product, [
                    'IsActive' => 1,
                    'Created_at' => now(),
                    'Updated_at' => now(),
                ]));
            }

            // categories / categorieën aanmaken
            $categoryIds = [];
            $categories = [
                ['name' => 'AGF',  'description' => 'Aardappelen groente en fruit'],
                ['name' => 'KV',   'description' => 'Kaas en vleeswaren'],
                ['name' => 'ZPE',  'description' => 'Zuivel plantaardig en eieren'],
                ['name' => 'BB',   'description' => 'Bakkerij en Banket'],
                ['name' => 'FSKT', 'description' => 'Frisdranken, sappen, koffie en thee'],
                ['name' => 'PRW',  'description' => 'Pasta, rijst en wereldkeuken'],
                ['name' => 'SSKO', 'description' => 'Soepen, sauzen, kruiden en olie'],
                ['name' => 'SKCC', 'description' => 'Snoep, koek, chips en chocolade'],
                ['name' => 'BVH',  'description' => 'Baby, verzorging en hygiëne'],
            ];
            foreach ($categories as $category) {
                $categoryIds[] = DB::table('Categories')->insertGetId(array_merge($category, [
                    'IsActive' => 1,
                    'Created_at' => now(),
                    'Updated_at' => now(),
                ]));
            }
            // Warehouses / magazijn aanmaken
            $warehouseIds = [];
            $warehouses = [
                ['receipt_date' => '2024-05-12', 'delivery_date' => null, 'packaging_unit' => '5 kg', 'quantity' => 20],
                ['receipt_date' => '2024-05-26', 'delivery_date' => null, 'packaging_unit' => '2.5 kg', 'quantity' => 40],
                ['receipt_date' => '2024-04-02', 'delivery_date' => null, 'packaging_unit' => '1 kg', 'quantity' => 30],
                ['receipt_date' => '2024-05-16', 'delivery_date' => null, 'packaging_unit' => '1.5 kg', 'quantity' => 25],
                ['receipt_date' => '2024-05-23', 'delivery_date' => null, 'packaging_unit' => '4 stuks', 'quantity' => 75],
                ['receipt_date' => '2024-03-12', 'delivery_date' => null, 'packaging_unit' => '1 kg/tros', 'quantity' => 60],
                ['receipt_date' => '2024-03-19', 'delivery_date' => null, 'packaging_unit' => '2 kg/tros', 'quantity' => 200],
                ['receipt_date' => '2024-06-19', 'delivery_date' => null, 'packaging_unit' => '200 g', 'quantity' => 45],
                ['receipt_date' => '2024-07-23', 'delivery_date' => null, 'packaging_unit' => '100 g', 'quantity' => 60],
                ['receipt_date' => '2024-07-23', 'delivery_date' => null, 'packaging_unit' => '1 liter', 'quantity' => 120],
                ['receipt_date' => '2024-06-02', 'delivery_date' => null, 'packaging_unit' => '250 g', 'quantity' => 80],
                ['receipt_date' => '2024-01-04', 'delivery_date' => null, 'packaging_unit' => '6 stuks', 'quantity' => 120],
                ['receipt_date' => '2024-04-07', 'delivery_date' => null, 'packaging_unit' => '800 g', 'quantity' => 220],
                ['receipt_date' => '2024-04-04', 'delivery_date' => null, 'packaging_unit' => '1 stuk', 'quantity' => 130],
                ['receipt_date' => '2024-04-28', 'delivery_date' => null, 'packaging_unit' => '150 ml', 'quantity' => 72],
                ['receipt_date' => '2024-04-19', 'delivery_date' => null, 'packaging_unit' => '1 l', 'quantity' => 12],
                ['receipt_date' => '2024-04-23', 'delivery_date' => null, 'packaging_unit' => '250 g', 'quantity' => 300],
                ['receipt_date' => '2024-03-02', 'delivery_date' => null, 'packaging_unit' => '25 zakjes', 'quantity' => 280],
                ['receipt_date' => '2024-04-16', 'delivery_date' => null, 'packaging_unit' => '500 g', 'quantity' => 330],
                ['receipt_date' => '2024-04-25', 'delivery_date' => null, 'packaging_unit' => '1 kg', 'quantity' => 34],
                ['receipt_date' => '2024-04-13', 'delivery_date' => null, 'packaging_unit' => '50 g', 'quantity' => 23],
                ['receipt_date' => '2024-04-23', 'delivery_date' => null, 'packaging_unit' => '1 l', 'quantity' => 46],
                ['receipt_date' => '2024-04-21', 'delivery_date' => null, 'packaging_unit' => '250 ml', 'quantity' => 98],
                ['receipt_date' => '2024-04-30', 'delivery_date' => null, 'packaging_unit' => '1 potje', 'quantity' => 56],
                ['receipt_date' => '2024-04-27', 'delivery_date' => null, 'packaging_unit' => '1 l', 'quantity' => 210],
                ['receipt_date' => '2024-04-01', 'delivery_date' => null, 'packaging_unit' => '4 stuks', 'quantity' => 24],
                ['receipt_date' => '2024-04-07', 'delivery_date' => null, 'packaging_unit' => '300 g', 'quantity' => 87],
                ['receipt_date' => '2024-04-22', 'delivery_date' => null, 'packaging_unit' => '200 g', 'quantity' => 230],
                ['receipt_date' => '2024-04-21', 'delivery_date' => null, 'packaging_unit' => '80 g', 'quantity' => 30],
            ];


            foreach ($warehouses as $warehouse) {
                $warehouseIds[] = DB::table('Warehouses')->insertGetId(array_merge($warehouse, [
                    'IsActive' => 1,
                    'Created_at' => now(),
                    'Updated_at' => now(),
                ]));
            }

            // product_per_warehouses - magazijn aanmaken (koppeling producten aan magazijnen)
            $productPerWarehouseIds = [];
            $productPerWarehouses = [
                ['product_id' => 1, 'warehouse_id' => 1, 'location' => 'Berlicum'],
                ['product_id' => 2, 'warehouse_id' => 2, 'location' => 'Rosmalen'],
                ['product_id' => 3, 'warehouse_id' => 3, 'location' => 'Berlicum'],
                ['product_id' => 4, 'warehouse_id' => 4, 'location' => 'Berlicum'],
                ['product_id' => 5, 'warehouse_id' => 5, 'location' => 'Rosmalen'],
                ['product_id' => 6, 'warehouse_id' => 6, 'location' => 'Berlicum'],
                ['product_id' => 7, 'warehouse_id' => 7, 'location' => 'Rosmalen'],
                ['product_id' => 8, 'warehouse_id' => 8, 'location' => 'Sint-MichelsGestel'],
                ['product_id' => 9, 'warehouse_id' => 9, 'location' => 'Sint-MichelsGestel'],
                ['product_id' => 10, 'warehouse_id' => 10, 'location' => 'Middelrode'],
                ['product_id' => 11, 'warehouse_id' => 11, 'location' => 'Middelrode'],
                ['product_id' => 12, 'warehouse_id' => 12, 'location' => 'Middelrode'],
                ['product_id' => 13, 'warehouse_id' => 13, 'location' => 'Schijndel'],
                ['product_id' => 14, 'warehouse_id' => 14, 'location' => 'Schijndel'],
                ['product_id' => 15, 'warehouse_id' => 15, 'location' => 'Gemonde'],
                ['product_id' => 16, 'warehouse_id' => 16, 'location' => 'Gemonde'],
                ['product_id' => 17, 'warehouse_id' => 17, 'location' => 'Gemonde'],
                ['product_id' => 18, 'warehouse_id' => 18, 'location' => 'Gemonde'],
                ['product_id' => 19, 'warehouse_id' => 19, 'location' => 'Den Bosch'],
                ['product_id' => 20, 'warehouse_id' => 20, 'location' => 'Den Bosch'],
                ['product_id' => 21, 'warehouse_id' => 21, 'location' => 'Den Bosch'],
                ['product_id' => 22, 'warehouse_id' => 22, 'location' => 'Heeswijk Dinther'],
                ['product_id' => 23, 'warehouse_id' => 23, 'location' => 'Heeswijk Dinther'],
                ['product_id' => 24, 'warehouse_id' => 24, 'location' => 'Heeswijk Dinther'],
                ['product_id' => 25, 'warehouse_id' => 25, 'location' => 'Vught'],
                ['product_id' => 26, 'warehouse_id' => 26, 'location' => 'Vught'],
                ['product_id' => 27, 'warehouse_id' => 27, 'location' => 'Vught'],
                ['product_id' => 28, 'warehouse_id' => 28, 'location' => 'Vught'],
                ['product_id' => 29, 'warehouse_id' => 29, 'location' => 'Vught'],
            ];


            foreach ($productPerWarehouses as $ppw) {
                DB::table('product_per_warehouses')->insert(array_merge($ppw, [
                    'IsActive' => 1,
                    'Created_at' => now(),
                    'Updated_at' => now(),
                ]));
            }

            // Admin gebruiker aanmaken
            User::factory()->create([
                'name' => 'Voedselbank Beheerder',
                'email' => 'admin@voedselbank-maaskantje.nl',
                'password' => Hash::make('wachtwoord'),
            ]);
            User::factory()->create([
                'name' => 'Voedselbank Beheerder',
                'email' => 'test@example.com',
                'password' => Hash::make('cookie123'),
            ]);
        }
    }
}
