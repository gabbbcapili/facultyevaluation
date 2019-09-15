<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['name' => 'Database Programming 1']);
        Subject::create(['name' => 'Database Programming 2']);
        Subject::create(['name' => 'Database Programming 3']);
        Subject::create(['name' => 'Database Programming 4']);
        Subject::create(['name' => 'Web Development 1']);
        Subject::create(['name' => 'Web Development 2']);
        Subject::create(['name' => 'Web Development 3']);
    }
}
