<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\User;
use App\Department;

class Section extends Model
{
    protected $table = 'sections';

    protected $fillable = ['name', 'is_deleted', 'course_id'];

    public function students(){
    	return $this->hasMany(User::class, 'section_id')->where('role', 'student')->where('active', true);
    }

    public function course(){
    	return $this->belongsTo(Course::class, 'course_id');
    }
}
