<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Evaluation;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->user()->isStudent()){
            $evaluated = $request->user()->studentEvaluations()->pluck('evaluation_id')->toArray();
            $today = date('Y-m-d H:i:s');
            $evaluations = Evaluation::whereNotIn('id', $evaluated)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->where('department_id', $request->user()->department_id)->get();
            return view('home', compact('evaluations'));
        }
        return view('home');
    }
}
