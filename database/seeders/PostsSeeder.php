<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        $json = File::get("database/data/posts.json");
        $data = json_decode($json);
        foreach($data as $obj){
            Post::create(array(
                'title' => $obj->title,
                'slug' => Str::slug(rand() . $obj->title),
                'description' => $obj->description,
                'state' => $obj->state,
                'user_id' => $obj->user_id,
                'city_slug' => $obj->city_slug,
                'category_slug' => $obj->category_slug,
                'subcategory_slug' => $obj->subcategory_slug,
            ));
        }
    }
}
