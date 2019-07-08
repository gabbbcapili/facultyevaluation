<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id', 'faculty_id', 'student_id' ,  'first_name', 'middle_name', 'last_name', 'username' , 'bday', 'civil_status', 'contact_number' , 'email', 'password' , 'role', 'gender', 'active'
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
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function department(){
        return $this->belongsTo(\App\Department::class, 'department_id', 'id');
    }
}
