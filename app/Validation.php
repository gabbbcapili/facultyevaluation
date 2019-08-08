<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    public static function userValidator($id = null){
        // unique:table,column,except,idColumn
    	return [
    		'department_id' => ['required'],
            'course_id' => [ 'sometimes','required'],
            'section_id' => [ 'sometimes','required'],
            'student_id' => ['sometimes', 'required', 'int' ,  'unique:users,student_id' , 'unique:users,faculty_id'],
    		'faculty_id' => ['sometimes', 'required', 'int' ,  'unique:users,student_id' , 'unique:users,faculty_id'],
            'role' => ['sometimes', 'required'],
    		'first_name' => ['required'],
    		'last_name' => ['required'],
            'email' => ['required' , 'email', 'unique:users,email,' . $id],
    		'bday' => ['required'],
    		'civil_status' => ['required'],
    		'contact_number' => ['required' , 'regex:/^(09|\+639)\d{9}$/'],
            'gender' => ['required'],
    	];
    }

    public static function userCsvValidator(){
        return [
            'department_id' => ['required'],
            'course_id' => ['required'],
            'section_id' => ['required'],
            'file' => ['required', 'mimes:csv,txt']
        ];
    }

    public static function evaluationValidator(){
        return [
            'evaluation_id' => ['required'],
            'subject' => ['required'],
            'semester' => ['required'],
            'q1' => ['required'],
            'q2' => ['required'],
            'q3' => ['required'],
            'q4' => ['required'],
            'q5' => ['required'],
            'q6' => ['required'],
            'q7' => ['required'],
            'q8' => ['required'],
            'q9' => ['required'],
            'q10' => ['required'],
            'q11' => ['required'],
            'q12' => ['required'],
            'q13' => ['required'],
            'q14' => ['required'],
            'comments' => ['required'],
        ];

    }
}
