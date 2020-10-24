<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $json = File::get("database/data/categories.json");
        $data = json_decode($json);
        foreach($data as $obj){
            Categories::create(array(
                'name' => $obj->name,
                'slug' => Str::slug($obj->name),
            ));
        }
    }
}
