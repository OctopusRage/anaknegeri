<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        Category::create([
            'category'   => 'Beasiswa'
        ]);

        Category::create([
            'category'   => 'Kelompok Belajar'
        ]);

        Category::create([
            'category'   => 'Indonesia Berkarya'
        ]);

        
    }
}
