<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Evaluation;

class EvaluationList extends Model
{

	protected $table = 'evaluationslist';

    protected $fillable = ['evaluation_id', 'subject', 'semester', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11'
							    , 'q12', 'q13', 'q14', 'comments', 'user_id'
							];

	public function student(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function totalCoursePlanning(){
		return ($this->q1 + $this->q2 + $this->q3) . '/15'; 
	}

	public function totalInstructionalDelivery(){
		return ($this->q4 + $this->q5 + $this->q6 + $this->q7) . '/20'; 
	}

	public function totalAssessment(){
		return ($this->q8 + $this->q9). '/10'; 
	}

	public function totalClassroomManagement(){
		return ($this->q10 + $this->q11). '/10'; 
	}

	public function totalPersonalityandPoise(){
		return ($this->q12 + $this->q13 + $this->q14). '/15'; 
	}

	public function evaluation(){
		return $this->belongsTo(Evaluation::class, 'evaluation_id');
	}

}
