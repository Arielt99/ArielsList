<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $json = File::get("database/data/users.json");
        $data = json_decode($json);
        foreach($data as $obj){
            User::create(array(
                'name' => $obj->name,
                'email' => $obj->email,
                'password' => Hash::make($obj->password),
                'default_city' => $obj->default_city,
            ));
        }
    }
}
