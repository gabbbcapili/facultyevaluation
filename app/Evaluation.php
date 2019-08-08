<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use App\EvaluationList;

class Evaluation extends Model
{

	protected $fillable = ['user_id', 'start_date', 'end_date', 'department_id'];

    public function faculty(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function department(){
    	return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function checkDate(){
    	$today = date('Y-m-d H:i:s');
    	$eval = $this->where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('id', $this->id)->get();
    	if($eval->count() == 0){
    		abort(404);
    	}else{
    		return true;
    	}
    }

    public function list(){
        return $this->hasMany(EvaluationList::class, 'evaluation_id');
    }
}
