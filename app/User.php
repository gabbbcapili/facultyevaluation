<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Department;
use App\Course;
use App\Section;
use App\Evaluation;
use App\EvaluationList;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id', 'faculty_id', 'student_id' ,  'first_name', 'middle_name', 'last_name', 'username' , 'bday', 'civil_status', 'contact_number' , 'email', 'password' , 'role', 'gender', 'active', 'section_id', 'course_id', 'subjects'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        if (env('ADMIN') == $this->username){
            return true;
        }else{
            return false;
        }
    }

    public function isEmployee(){
        if ($this->role == 'faculty'){
            return true;
        }else if($this->role == 'dean'){
            return true;
        }else if($this->role == 'secretary'){
            return true;
        }else if($this->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    public function isSecretary(){
        if ($this->role == 'student'){
            return true;
        }else{
            return false;
        }
    }

    public function isStudent(){
        if ($this->role == 'student'){
            return true;
        }else{
            return false;
        }
    }

    public function isFaculty(){
        if ($this->role == 'faculty'){
            return true;
        }else{
            return false;
        }
    }

    public static function getCivilStatus(){
        return [
            'Single',
            'Married',
            'Widowed',
            'Separated',
            'Divorced',
        ];
    }

    public function getProfilePicture(){
         return url('/images/' . $this->profile_img);
      }

    public function getFullName(){
        return ucfirst($this->first_name) . ' ' . ucfirst($this->middle_name) . ' ' . ucfirst($this->last_name);
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
    public static function studentCsvHeader(){
        return [
            'Student ID', 'First Name', 'Middle Name', 'Last Name', 'Email', 'Contact Number', 'Birth Date', 'Gender'
        ];
    }

    public function studentEvaluations(){
        return $this->hasMany(EvaluationList::class, 'user_id');
    }
}
