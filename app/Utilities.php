<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{

	public static function format_date($date, $format = 'm-d-Y'){
		return date_format(date_create($date), $format);
	}

	public static function viewButtonHref($action){
		return'<a target="_blank" href="'. $action .'" data-toggle="tooltip" data-placement="top" title="View"" class="btn btn-primary btn-sm margin-r-10"><i class="fa fa-eye"></i>';
	}

	public static function viewButton($action){
		return'<a href="#" data-toggle="tooltip" data-placement="top" title="View"" data-href="'. $action . '" class="btn btn-primary btn-sm margin-r-10 modal_button"><i class="fa fa-eye"></i>';
	}

	public static function editButton($action){
		return'<a href="#" data-toggle="tooltip" data-placement="top" title="Edit"" data-href="'. $action . '" class="btn btn-primary btn-sm margin-r-10 modal_button"><i class="fa fa-edit"></i>';
	}

    public static function deleteButton($action){
    	return '<a href="#" data-toggle="tooltip" data-placement="top" title="Delete" data-href="'. $action . '" class="btn btn-danger btn-sm modal_button"><i class="fa fa-trash"></i>';
    }

    public static function dictionaryDropDownType($dictionaryType, $id){
    	$types = ['Negative', 'Neutral', 'Positive'];
    	$string =  '<select class="form-control type" data-id="'. $id .'" name="type" style="width:100%">';
    	foreach($types as $type){
    		$selected = '';
    		if($type == $dictionaryType){
    			$selected = 'selected';
    		}
    		$string .= '<option value="'. $type .'" '. $selected .'>'. $type .' </option>';
    	}
    	$string .= '</select>';
    	return  $string;
    }
}
