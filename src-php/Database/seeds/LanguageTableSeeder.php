<?php

namespace Maxfactor\CMS\Database\Seeds;

use Illuminate\Database\Seeder;
use Maxfactor\CMS\Models\Language;

class LanguageTableSeeder extends Seeder
{
    public function run()
    {
        factory(Language::class, 3)->create();
    }
}
