<?php

use Illuminate\Database\Seeder;

class Post extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 15)->create()->each(function ($post){
            $post->save();
        });
    }
}
