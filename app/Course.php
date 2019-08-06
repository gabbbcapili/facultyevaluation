<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\User;
use App\Section;

class Course extends Model
{
     protected $table = 'courses';

    protected $fillable = ['name', 'is_deleted', 'department_id'];

    public function students(){
    	return $this->hasMany(User::class, 'course_id')->where('role', 'student')->where('active', true);
    }

    public function department(){
    	return $this->belongsTo(Department::class, 'department_id');
    }

    public function sections(){
    	return $this->hasMany(Section::class, 'course_id');
    }
}
