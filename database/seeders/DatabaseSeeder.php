<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
