<?php

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
        $this->call([
            \Maxfactor\CMS\Database\Seeds\RoleTableSeeder::class,
            \Maxfactor\CMS\Database\Seeds\UserTableSeeder::class,
            \Maxfactor\CMS\Database\Seeds\LanguageTableSeeder::class,
        ]);
    }
}
