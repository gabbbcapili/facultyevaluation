<?php

use Illuminate\Database\Seeder;
use App\Section;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create(['course_id' => 1, 'name' => '1-A']);
        Section::create(['course_id' => 1, 'name' => '1-B']);
        Section::create(['course_id' => 1, 'name' => '2-A']);
        Section::create(['course_id' => 1, 'name' => '2-B']);
        Section::create(['course_id' => 1, 'name' => '3-A']);
        Section::create(['course_id' => 1, 'name' => '3-B']);
        Section::create(['course_id' => 1, 'name' => '4-A']);
        Section::create(['course_id' => 1, 'name' => '4-B']);

        Section::create(['course_id' => 2, 'name' => '1-A']);
        Section::create(['course_id' => 2, 'name' => '1-B']);
        Section::create(['course_id' => 2, 'name' => '2-A']);
        Section::create(['course_id' => 2, 'name' => '2-B']);
        Section::create(['course_id' => 2, 'name' => '3-A']);
        Section::create(['course_id' => 2, 'name' => '3-B']);
        Section::create(['course_id' => 2, 'name' => '4-A']);
        Section::create(['course_id' => 2, 'name' => '4-B']);

        Section::create(['course_id' => 3, 'name' => '1-A']);
        Section::create(['course_id' => 3, 'name' => '1-B']);
        Section::create(['course_id' => 3, 'name' => '2-A']);
        Section::create(['course_id' => 3, 'name' => '2-B']);
        Section::create(['course_id' => 3, 'name' => '3-A']);
        Section::create(['course_id' => 3, 'name' => '3-B']);
        Section::create(['course_id' => 3, 'name' => '4-A']);
        Section::create(['course_id' => 3, 'name' => '4-B']);
    }
}
