<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{

	public static function format_date($date, $format = 'm-d-Y'){
		return date_format(date_create($date), $format);
	}

	public static function editButton($action){
		return'<a href="#" data-toggle="tooltip" data-placement="top" title="Edit"" data-href="'. $action . '" class="btn btn-primary btn-sm margin-r-10 modal_button"><i class="fa fa-edit"></i>';
	}

    public static function deleteButton($action){
    	return '<a href="#" data-toggle="tooltip" data-placement="top" title="Delete" data-href="'. $action . '" class="btn btn-danger btn-sm modal_button"><i class="fa fa-trash"></i>';
    }
}
