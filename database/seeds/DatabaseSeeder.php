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
        $this->call(UsersTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(EvaluationTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
    }
}
