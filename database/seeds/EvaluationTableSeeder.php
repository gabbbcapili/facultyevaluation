<?php

use Illuminate\Database\Seeder;
use App\Evaluation;

class EvaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluation::create([
        	'department_id' => 1,
        	'start_date' => '2019-08-07 04:41:32',
        	'end_date' => '2019-08-08 04:41:32',
        	'user_id' => '5',
        ]);
    }
}
