<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(Section::TABLE_NAME)->insert(
            [
                'caption' => 'Новости',
                'body' => '<p>Описание раздела Новости</p>'
            ]
        );
        DB::table(Section::TABLE_NAME)->insert(
            [
                'caption' => 'Контакты',
            ]
        );
    }
}
