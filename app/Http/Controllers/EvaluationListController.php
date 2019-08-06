<?php

namespace App\Http\Controllers;

use App\EvaluationList;
use App\Evaluation;
use Illuminate\Http\Request;

class EvaluationListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('evaluation_id');
        $evaluation = Evaluation::findOrFail($id);
        return view('evaluation_list.create', compact('evaluation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvaluationList  $evaluationList
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluationList $evaluationList)
    {
        //
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
