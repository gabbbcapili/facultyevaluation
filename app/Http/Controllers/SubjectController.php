<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Faker\Factory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Utilities;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $subject = Subject::select('id','name', 'is_deleted')
                                    ->where('is_deleted', false)
                                    ->orderBy('id','DESC');
            return Datatables::of($subject)
                ->addColumn('action', function(Subject $subject) {
                            $html = Utilities::editButton(action('SubjectController@edit', [$subject->id]));
                            $html .= Utilities::deleteButton(action('SubjectController@delete', [$subject->id]));
                            return $html;
                        })
                ->make(true);
        }
        return view('subject.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            }
        try {
            DB::beginTransaction();
            Subject::create($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Subject added successfully!'
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
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            }
        try {
            DB::beginTransaction();
            $subject->update($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Subject updated successfully!'
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
     public function destroy(Subject $subject)
    {
         try {
            DB::beginTransaction();
            $subject->update(['is_deleted' => true]);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Subject successfully deleted!'
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

    public function delete(Subject $subject){
        $action = action('SubjectController@destroy', $subject->id);
        $title = 'subject ' . $subject->name;
       return view('layouts.delete', compact('action' , 'title'));
    }
}
