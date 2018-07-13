<?php

namespace Maxfactor\CMS\Database\Seeds;

use Maxfactor\CMS\Models\Role;
use Illuminate\Database\Seeder;
use Silvanite\Brandenburg\Policy;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 5)->create();
    }
}
