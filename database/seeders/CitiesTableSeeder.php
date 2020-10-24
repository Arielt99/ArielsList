<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cities;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        $json = File::get("database/data/cities.json");
        $data = json_decode($json);
        foreach($data as $obj){
            Cities::create(array(
                'name' => $obj->name,
                'slug' => Str::slug($obj->name),
                'postal_code' => $obj->postal_code,
            ));
        }
    }
}
