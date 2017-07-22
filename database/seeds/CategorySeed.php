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
            'category'   => 'Beasiswa',
            'slug' => 'beasiswa'
        ]);

        Category::create([
            'category'   => 'Kelompok Belajar',
            'slug' => 'kelompok-belajar'
        ]);

        Category::create([
            'category'   => 'Indonesia Berkarya',
            'slug' => 'indonesia-berkarya'
        ]);

        
    }
}
