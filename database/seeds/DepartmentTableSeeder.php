<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'College of Computing Studies']);
         Department::create(['name' => 'College of Engineering']);
    }
}
