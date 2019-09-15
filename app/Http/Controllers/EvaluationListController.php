<?php

namespace App\Http\Controllers;

use App\EvaluationList;
use App\Evaluation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Utilities;
use App\Validation;
use App\subject;

class EvaluationListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $evaluation = EvaluationList::select();
            return Datatables::eloquent($evaluation)
                ->addColumn('faculty', function(EvaluationList $evaluation) {
                           return $evaluation->evaluation ? $evaluation->evaluation->faculty->getFullName() : '--';
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
                ->addColumn('date', function(EvaluationList $evaluation) {
                           return Utilities::format_date($evaluation->created_at, 'M d, Y');
                        })
                ->addColumn('action', function(EvaluationList $evaluation) {
                            $html = Utilities::viewButtonHref(action('EvaluationListController@show', [$evaluation->id]));
                            return $html;
                        })
                ->make(true);
        }
        return view('evaluation_list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('e_id');
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->checkDate();
        $subjects = Subject::whereIn('id', explode(',', $evaluation->faculty->subjects))->get();
        return view('evaluation_list.create', compact('evaluation', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Validation::evaluationValidator(), ['required' => 'This field is required.']);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'msg' => 'Please check for errors']);
        }
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            EvaluationList::create($data);

            $comments = explode(' ',$request->input('comments'));
            $comments = EvaluationList::unsetInvalidComments($comments);
            EvaluationList::createDictionaries($comments);
            DB::commit();
            $request->session()->flash('status', 'Successfully submitted an Evaluation!');
            $output = ['success' => 1,
                        'msg' => 'Successfully submitted an Evaluation!'
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

    /**
     * Display the specified resource.
     *
     * @param  \App\EvaluationList  $evaluationList
     * @return \Illuminate\Http\Response
     */
    public function show($evaluationList)
    {  
        $evaluationList = EvaluationList::findOrFail($evaluationList);
        return view('evaluation_list.show', compact('evaluationList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EvaluationList  $evaluationList
     * @return \Illuminate\Http\Response
     */
    public function edit(EvaluationList $evaluationList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvaluationList  $evaluationList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluationList $evaluationList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvaluationList  $evaluationList
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluationList $evaluationList)
    {
        //
    }
}
