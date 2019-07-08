<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    public static function userValidator($id = null){
        // unique:table,column,except,idColumn
    	return [
    		'department_id' => ['required'],
    		'faculty_id' => ['sometimes', 'int' , 'required', 'unique:users'],
    		'first_name' => ['required'],
    		'last_name' => ['required'],
            'email' => ['required' , 'email', 'unique:users,email,' . $id],
    		'bday' => ['required'],
    		'civil_status' => ['required'],
    		'contact_number' => ['required' , 'regex:/^(09|\+639)\d{9}$/'],
            'gender' => ['required'],
    	];
    }
}
