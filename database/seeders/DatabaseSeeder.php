<?php

namespace Database\Seeders;

use App\Models\AdminProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DocumentSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(StorefrontSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(SeasonsSeeder::class);
        $this->call(OtherServerSettingsSeeder::class);
        $this->call(MessageTemplatesSeeder::class);
        $this->call(ProductStoreFrontsSeeder::class);
        $this->call(VendorsSeeder::class);
        //$this->call(UserOrdersSeeder::class);
        $this->call(AdminProductSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(LocationSettingsSeeder::class);
        $this->call(ColorsSeeder::class);
        $this->call(ProductOptionSeeder::class);
        $this->call(PushMessageTemplatesSeeder::class);
    }
}
