<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Department extends Model
{
    //

    protected $table = 'department';

    protected $fillable = ['name', 'is_deleted'];

    public function students(){
    	return$this->hasMany(User::class, 'department_id')->where('role', 'student')->where('active', true);
    }
    public function faculty(){
    	return$this->hasMany(User::class, 'department_id')->where('role', 'faculty')->where('active', true);
    }
}
