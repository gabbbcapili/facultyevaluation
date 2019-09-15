@extends('layouts.base')
@section('title', 'Create Evaluation List')

@section('content')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
<form action="{{ action('EvaluationListController@store') }}" method="POST" class="form" enctype='multipart/form-data'>
    @csrf
    <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">
<!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Evaluation
        <small>evaluate faculties</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header text-center title-centered">
         		  <div>Republic of the Philippines</div>
	              <div><b>DON HONORIO VENTURA STATE UNIVERSITY</b></div>
				  <div>Bacolor, Pampanga</div><br>
				  <div><b>STUDENT EVALUATION (Form 1)</b></div>
				  <div><b>{{ $evaluation->department ? $evaluation->department->name : ''  }}</b></div>
            </div> <!-- /.box-header -->
            <div class="box-header title-centered">
            	<div class="row">
                <div class="col-sm-12" style="word-break: break-word; white-space: normal;">
            	Faculty Code:
            	<b class="border margin-r-5">{{ $evaluation->faculty->faculty_id }}</b>	
            	<b class="border">{{ $evaluation->faculty->getFullName() }} </b>
            	</div>
              </div>
              <br>
            	<div>
            		Date:
            		<b>{{ date_format(today(), 'M d, Y') }}</b>
            	</div><br>
            	<div class="col-sm-6">
            		<div class="form-group">
            			Subject:<select class="form-control" name="subject" id="subject">
                    <option hidden selected disabled></option>
                    @foreach($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>   
                    @endforeach
                  </select>
            		</div>
            	</div>
            	<div class="col-sm-2">
            	</div>
            	<div class="col-sm-4">
            		<div class="form-group">
            			Semester:
                  <select type="text" class="form-control" name="semester" id="semester">
                    <option hidden selected disabled></option>
                    <option>A.Y. {{ Carbon\Carbon::now()->format('Y') }}-{{ Carbon\Carbon::now()->addMonths(12)->format('Y') }} 1st Semester</option>
                    <option>A.Y. {{ Carbon\Carbon::now()->format('Y') }}-{{ Carbon\Carbon::now()->addMonths(12)->format('Y') }} 2nd Semester</option>
                  </select>
            		</div>
            	</div>
            	<div style="margin-left:5%">
            		Direction: Encircle the number that represents the rating that best describes the performance of your instructor. <br> Rest assured that the information you will give will be treated with the strictest confidentiality.
            	</div><br>
            	
            </div>
            <div class="box-header text-center title-centered">
            	<div>
            		Rating scale:<br>
                                                       		            1-Unsatisfactory               2-Fair	 <br>
                                              3-Satisfactory  4-Very Satisfactory                                      <br>
                                                5-Outstanding 

            	</div>
            </div>
             <div class="box-body times" style="margin-left:5%; margin-right: 5%;">
             	<div class="row times">
                <div class="col-sm-4">
                  <h3><b>I. <span class="margin-r-20"></span> Course Panning/Preparation</b></h3>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>1. Demonstrates mastery of the subject matter </span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q1">
                    <label class="margin-r-5"><input type="radio" name="q1" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="1"> 1</label>
                  </div>
                </div>
              </div>

              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>2.  Plans lessons effectively according to the objectives of the course</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q2">
                    <label class="margin-r-5"><input type="radio" name="q2" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>3. Explains subject requirements properly and provides reasonable time for their completion</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q3">
                    <label class="margin-r-5"><input type="radio" name="q3" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <!-- r1 -->

              <div class="row times">
                <div class="col-sm-4">
                  <h3><b>II. <span class="margin-r-20"></span> Instructional Delivery</b></h3>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>1. Demonstrates mastery of the subject matter </span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q4">
                    <label class="margin-r-5"><input type="radio" name="q4" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="1"> 1</label>
                  </div>
                </div>
              </div>

              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>2.  Motivates students to think critically and creatively</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q5">
                    <label class="margin-r-5"><input type="radio" name="q5" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>3.  Has a good command of the language of instruction with well modulated voice that can be understood by all students</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q6">
                    <label class="margin-r-5"><input type="radio" name="q6" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="1"> 1</label>
                  </div>
                </div>
              </div>

              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>4.  Comes to class on time and makes productive use of allotted time for the subject</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q7">
                    <label class="margin-r-5"><input type="radio" name="q7" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <!-- r2 -->

              <div class="row times">
                <div class="col-sm-4">
                  <h3><b>III.<span class="margin-r-20"></span>  Assessment of Student Learning</b></h3>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>1.  Uses appropriate assessment strategies to evaluate learning </span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q8">
                    <label class="margin-r-5"><input type="radio" name="q8" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="1"> 1</label>
                  </div>
                </div>
              </div>

              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>2.  Is fair and objective in giving grades  </span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q9">
                    <label class="margin-r-5"><input type="radio" name="q9" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <!-- r3  -->

              <div class="row times">
                <div class="col-sm-4">
                  <h3><b>IV.<span class="margin-r-20"></span> Classroom Management</b></h3>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>1.  Maintains order in the class  </span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q10">
                    <label class="margin-r-5"><input type="radio" name="q10" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="1"> 1</label>
                  </div>
                </div>
              </div>

              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>2.  Is approachable but firm implementation of policies </span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q11">
                    <label class="margin-r-5"><input type="radio" name="q11" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <!-- r4  -->


              <div class="row times">
                <div class="col-sm-4">
                  <h3><b>V. <span class="margin-r-20"></span> Personality and Poise</b></h3>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>1. Well groomed and has pleasing personality</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q12">
                    <label class="margin-r-5"><input type="radio" name="q12" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="1"> 1</label>
                  </div>
                </div>
              </div>

              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>2.  Wears the prescribed uniform</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q13">
                    <label class="margin-r-5"><input type="radio" name="q13" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <div class="row times">
                <div class="col-sm-7">
                  <span class="margin-r-20"></span><span class="margin-r-20"></span>
                  <span>3. Has self-confidence and commands respect</span>    
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
                  <div class="form-group" id="q14">
                    <label class="margin-r-5"><input type="radio" name="q14" value="5"> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="4"> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="3"> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="2"> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="1"> 1</label>
                  </div>
                </div>
              </div>
              <!-- r5 -->

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Comments:</label>
                    <textarea class="form-control" name="comments" id="comments" rows="5"></textarea>
                  </div>
                </div>
              </div>  
              <div class="box-footer" style="text-align: center">
                <button type="submit" class="btn btn-lg btn-primary btn_save">Submit Evaluation</button>
              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </form>


@endsection

@section('javascript')
<script src="{{ asset('js/forms/form-evaluation.js') }}"></script>

@endsection