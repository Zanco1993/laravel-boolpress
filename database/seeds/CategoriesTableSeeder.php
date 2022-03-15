<?php

use App\Category;
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
        $categories = [

            [
                'name' => 'fantasy',
                'description' => 'content fantasy'
            ],
            [
                'name' => 'horror',
                'description' => 'content horror'
            ],
            [
                'name' => 'adventure',
                'description' => 'content adventure'
            ],
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->fill($category);
            $newCategory->save();
        }
    }
}
