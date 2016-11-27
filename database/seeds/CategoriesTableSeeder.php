<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['Taiwan', 'Culture', 'Lifestyle', 'World'])->each(function($category) {
            factory(\App\Content\Category::class)->create(['name' => ['en' => $category, 'zh' => 'Zh ' . $category]]);
        });
    }
}
