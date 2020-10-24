<?php

namespace Database\Seeders;

use App\Models\SubCategories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->delete();
        $json = File::get("database/data/subcategories.json");
        $data = json_decode($json);
        foreach($data as $obj){
            SubCategories::create(array(
                'name' => $obj->name,
                'slug' => Str::slug($obj->name),
                'category_slug' => $obj->category_slug,
            ));
        }
    }
}
