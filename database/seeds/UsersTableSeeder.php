<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Dhvsu',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'first_name' => 'Gabriel',
            'last_name' => 'Aquino',
            'username' => 'Capili',
            'student_id' => '201722015',
            'username' => 'gabriel',
            'department_id' => 1,
            'email' => 'gabbbcapili@gmail.com',
            'contact_number' => '09993586492',
            'gender' => 'Male',
            'role' => 'student',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'first_name' => 'Test',
            'last_name' => 'Test',
            'username' => 'Test',
            'student_id' => '201722016',
            'username' => 'test',
            'department_id' => 2,
            'email' => 'gabbcapili@gmail.com',
            'contact_number' => '09993486492',
            'gender' => 'Female',
            'role' => 'student',
            'password' => Hash::make('admin123'),
        ]);
    }
}
