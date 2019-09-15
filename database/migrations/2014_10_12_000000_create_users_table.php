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
            // $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
            $table->unsignedInteger('course_id')->nullable();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedInteger('section_id')->nullable();
            // $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_img')->default('default-profile.png');
            $table->string('bday')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('subjects')->nullable();
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
