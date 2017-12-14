<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user_ids =\App\Models\User::all()->pluck('id')->toArray();
        $category_ids = \App\Models\Category::all()->pluck('id')->toArray();

        $faker=app(\Faker\Generator::class);

        $posts = factory(\App\Models\Post::class)
            ->times(50)
            ->make()
            ->each(function($post,$index)
            use($user_ids,$category_ids,$faker){
                $post->user_id  = $faker->randomElement($user_ids);
                $post->category_id  =   $faker->randomElement($category_ids);
            });
        \App\Models\Post::insert($posts->toArray());

    }
}
