<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Evaluation;
use App\Subject;
use App\Dictionary;

class EvaluationList extends Model
{

	protected $table = 'evaluationslist';

    protected $fillable = ['evaluation_id', 'subject', 'semester', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11'
							    , 'q12', 'q13', 'q14', 'comments', 'user_id'
							];

	public function student(){
		return $this->belongsTo(User::class, 'user_id');
	}

	public function subjectclass(){
		return $this->belongsTo(Subject::class, 'subject');
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

	public static function unsetInvalidComments($comments, $length = 3){
		foreach($comments as $key => $value){
            if(strlen($value) <= $length){
                unset($comments[$key]);
            }
        }
        return $comments;
	}

	public static function createDictionaries(Array $comments){
		foreach($comments as $comment){
			if(Dictionary::where('word', $comment)->first() == null){
				Dictionary::create(['word' => strtoupper($comment)]);
			}
		}
	}

	public function getTotalForComments(){
		 $comments = $this->unsetInvalidComments(explode(' ', $this->comments));
		 $positive =  Dictionary::whereIn('word', $comments)->where('type', 'Positive')->count();
		 $neutral =  Dictionary::whereIn('word', $comments)->where('type', 'Neutral')->count();
		 $negative =  Dictionary::whereIn('word', $comments)->where('type', 'Negative')->count();

		 $string = '<br><font style="color:green"> Positive: ' . $positive . '</font><br> Neutral:  ' . $neutral . '<br><font style="color:red"> Negative: ' . $negative . '</font>';
		 return $string;
	}

}
