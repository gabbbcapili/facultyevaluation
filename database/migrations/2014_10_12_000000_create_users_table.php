<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->unique()->nullable();
            $table->unsignedInteger('faculty_id')->unique()->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->unsignedInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_img')->default('default-profile.png');
            $table->string('bday')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('gender')->nullable();
            $table->enum('role', ['admin', 'dean', 'secretary', 'student', 'faculty'])->default('student');
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
