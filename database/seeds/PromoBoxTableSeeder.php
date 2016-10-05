<?php

use Illuminate\Database\Seeder;

class PromoBoxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promo_box')->insert([
            'sku' => 'RZCRM',
            'description' => 'Shave Cream and Razor Box',
            'qty' => '10004',
        ]);
		
        DB::table('promo_box')->insert([
            'sku' => 'RZGEL',
            'description' => 'Shave Gel and Razor Box',
            'qty' => '9998',
        ]);
		
        DB::table('promo_box')->insert([
            'sku' => 'RXBLM',
            'description' => 'Shave Balm and Razor Box',
            'qty' => '10000',
        ]);
		
    }
}
