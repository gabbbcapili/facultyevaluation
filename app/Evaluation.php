<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Evaluation extends Model
{
    

    public function faculty(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
