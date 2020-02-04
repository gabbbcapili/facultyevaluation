<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use App\Department;
use Yajra\DataTables\Facades\DataTables;
use App\Utilities;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request){

            $department_id = $request->get('department_id');
            $employee_id = $request->get('employee_id');
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');
            if($department_id != 'all'){
                $evaluation->where('evaluations.department_id', $department_id);
            }
            if($employee_id != 'all'){
                $evaluation->whereHas('faculty', function ($query) use ($employee_id) {
                    $query->where('user_id', '=', $employee_id);
                });
            }


            if($start_date != null ){
                $evaluation->where('evaluations.start_date', '>=' , $start_date);
            }

            if($end_date != null ){
                $evaluation->where('evaluations.end_date', '<=' ,$end_date);
            }

            return Datatables::eloquent($evaluation)
                ->addColumn('faculty', function(Evaluation $evaluation) {
                           return $evaluation->faculty ? $evaluation->faculty->getFullName() : '--';
                        })
                ->addColumn('faculty_id', function(Evaluation $evaluation) {
                           return $evaluation->faculty ? $evaluation->faculty->faculty_id : '--';
                        })
                ->addColumn('action', function(Evaluation $evaluation) {
                            $html = Utilities::viewButton(action('EvaluationController@show', [$evaluation->id]));
                            if(request()->user()->isAdmin()){
                            $html .= Utilities::deleteButton(action('EvaluationController@delete', [$evaluation->id]));   
                            }
                            return $html;
                        })
                ->addColumn('department', function(Evaluation $evaluation) {
                           return $evaluation->department ? $evaluation->department->name : '--';
                        })
                ->make(true);
        }
        $departments = Department::all();
        return view('report.index', compact('departments'));
    }

    public function getEmployees(Department $department){
    	$employees = $department->faculty;
    	return view('report.getEmployees', compact('employees'));
    }
}
