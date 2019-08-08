<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create(['department_id' => 1, 'name' => 'Information Technology']);
        Course::create(['department_id' => 1, 'name' => 'Computer Science']);
        Course::create(['department_id' => 2, 'name' => 'Computer Engineering']);
    }
}
