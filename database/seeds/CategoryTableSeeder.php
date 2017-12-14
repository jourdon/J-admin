<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = factory(\App\Models\Category::class)
            ->times(5)
            ->make();
        \App\Models\Category::insert($category->toArray());
    }
}
