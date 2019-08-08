<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\EvaluationList;
use App\Course;
use App\Department;
use App\Utilities;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $evaluation = Evaluation::with('faculty', 'department')
                            ->select('evaluations.id', 'evaluations.user_id', 'evaluations.department_id' , 'evaluations.start_date', 'evaluations.end_date');
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
        return view('evaluation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->where('is_deleted', false);
        return view('evaluation.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['end_date' => ['required'], 'start_date' => ['required'],
                                                        'department_id' => ['required', 'exists:department,id']]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        try {
            DB::beginTransaction();
            $data = $request->all();
            $department = Department::find($request->input('department_id'));
            foreach($department->faculty as $faculty){
                $data['user_id'] = $faculty->id;
                Evaluation::create($data);
            }
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Evaluations added successfully!'
                    ];
            if($department->faculty->count() == 0){
                $output = ['success' => 0,
                        'msg' => 'No faculty in this department yet.'
                    ];
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). " Line:" . $e->getLine(). " Message:" . $e->getMessage());
            $output = ['success' => 0,
                        'msg' => env('APP_DEBUG') ? $e->getMessage() : 'Sorry something went wrong, please try again later.'
                    ];
             DB::rollBack();
        }
        return response()->json($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        return view('evaluation.show', compact('evaluation'));
    }

    public function getEvaluationList(Evaluation $evaluation)
    {
        if ( request()->ajax()) {
           $evaluation = EvaluationList::where('evaluation_id', $evaluation->id);
            return Datatables::eloquent($evaluation)
                ->addColumn('date', function(EvaluationList $evaluation) {
                           return Utilities::format_date($evaluation->created_at, 'M d, Y');
                        })
                ->addColumn('student', function(EvaluationList $evaluation) {
                           return $evaluation->student ? $evaluation->student->getFullName() : '--';
                        })
                ->addColumn('totalCoursePlanning', function(EvaluationList $evaluation) {
                           return $evaluation->totalCoursePlanning();
                        })
                ->addColumn('totalInstructionalDelivery', function(EvaluationList $evaluation) {
                           return $evaluation->totalInstructionalDelivery();
                        })
                ->addColumn('totalAssessment', function(EvaluationList $evaluation) {
                           return $evaluation->totalAssessment();
                        })
                ->addColumn('totalClassroomManagement', function(EvaluationList $evaluation) {
                           return $evaluation->totalClassroomManagement();
                        })
                ->addColumn('totalPersonalityandPoise', function(EvaluationList $evaluation) {
                           return $evaluation->totalPersonalityandPoise();
                        })
                ->addColumn('action', function(EvaluationList $evaluation) {
                            $html = Utilities::viewButtonHref(action('EvaluationListController@show', [$evaluation->id]));
                            return $html;
                        })
                ->make(true);
        }
        return view('evaluation.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        try {
            DB::beginTransaction();
            $evaluation->delete();
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Course successfully deleted!'
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). " Line:" . $e->getLine(). " Message:" . $e->getMessage());
            $output = ['success' => 0,
                        'msg' => env('APP_DEBUG') ? $e->getMessage() : 'Sorry something went wrong, please try again later.'
                    ];
             DB::rollBack();
        }
        return response()->json($output);
    }

    public function delete(Evaluation $evaluation)
    {
        $action = action('EvaluationController@destroy', $evaluation->id);
        $title = 'evaluation';
       return view('layouts.delete', compact('action' , 'title'));
    }
}
