@extends('layouts.base')
@section('title', 'View Evaluation')

@section('content')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
<!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Evaluation
        <small>view evaluation</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<div class="box-header text-center title-centered">
         		  <div>Republic of the Philippines</div>
	              <div><b>DON HONORIO VENTURA STATE UNIVERSITY</b></div>
				  <div>Bacolor, Pampanga</div><br>
				  <div><b>STUDENT EVALUATION (Form 1)</b></div>
				  <div><b>{{ $evaluationList->evaluation->department ? $evaluationList->evaluation->department->name : ''  }}</b></div>
            </div> <!-- /.box-header -->
            <div class="box-header title-centered">
            	<div class="row">
                <div class="col-sm-12" style="word-break: break-word; white-space: normal;">
                  Reference#: {{ $evaluationList->id }} <br><br>
            	Faculty Code:
            	<b class="border margin-r-5">{{ $evaluationList->evaluation->faculty->faculty_id }} </b>	
            	<b class="border">{{ $evaluationList->evaluation->faculty->getFullName() }} </b>
            	</div>
              </div>
              <br>
            	<div>
            		Date:
            		<b>{{ App\Utilities::format_date($evaluationList->created_at, 'M d, Y') }}</b>
            	</div><br>
            	<div class="col-sm-6">
            		<div class="form-group">
            			Subject: {{ ucfirst($evaluationList->subject) }}
            		</div>
            	</div>
            	<div class="col-sm-2">
            	</div>
            	<div class="col-sm-4">
            		<div class="form-group">
            			Semester: {{ ucfirst($evaluationList->semester) }}
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
                    <label class="margin-r-5"><input type="radio" name="q1" value="5" {{ $evaluationList->q1 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="4" {{ $evaluationList->q1 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="3" {{ $evaluationList->q1 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="2" {{ $evaluationList->q1 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q1" value="1" {{ $evaluationList->q1 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q2" value="5"  {{ $evaluationList->q2 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="4"  {{ $evaluationList->q2 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="3"  {{ $evaluationList->q2 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="2"  {{ $evaluationList->q2 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q2" value="1"  {{ $evaluationList->q2 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q3" value="5" {{ $evaluationList->q3 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="4" {{ $evaluationList->q3 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="3" {{ $evaluationList->q3 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="2" {{ $evaluationList->q3 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q3" value="1" {{ $evaluationList->q3 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q4" value="5" {{ $evaluationList->q4 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="4" {{ $evaluationList->q4 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="3" {{ $evaluationList->q4 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="2" {{ $evaluationList->q4 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q4" value="1" {{ $evaluationList->q4 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q5" value="5" {{ $evaluationList->q5 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="4" {{ $evaluationList->q5 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="3" {{ $evaluationList->q5 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="2" {{ $evaluationList->q5 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q5" value="1" {{ $evaluationList->q5 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q6" value="5" {{ $evaluationList->q6 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="4" {{ $evaluationList->q6 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="3" {{ $evaluationList->q6 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="2" {{ $evaluationList->q6 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q6" value="1" {{ $evaluationList->q6 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q7" value="5" {{ $evaluationList->q7 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="4" {{ $evaluationList->q7 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="3" {{ $evaluationList->q7 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="2" {{ $evaluationList->q7 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q7" value="1" {{ $evaluationList->q7 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q8" value="5" {{ $evaluationList->q8 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="4" {{ $evaluationList->q8 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="3" {{ $evaluationList->q8 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="2" {{ $evaluationList->q8 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q8" value="1" {{ $evaluationList->q8 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q9" value="5" {{ $evaluationList->q9 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="4" {{ $evaluationList->q9 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="3" {{ $evaluationList->q9 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="2" {{ $evaluationList->q9 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q9" value="1" {{ $evaluationList->q9 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q10" value="5" {{ $evaluationList->q10 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="4" {{ $evaluationList->q10 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="3" {{ $evaluationList->q10 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="2" {{ $evaluationList->q10 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q10" value="1" {{ $evaluationList->q10 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q11" value="5" {{ $evaluationList->q11 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="4" {{ $evaluationList->q11 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="3" {{ $evaluationList->q11 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="2" {{ $evaluationList->q11 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q11" value="1" {{ $evaluationList->q11 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q12" value="5" {{ $evaluationList->q12 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="4" {{ $evaluationList->q12 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="3" {{ $evaluationList->q12 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="2" {{ $evaluationList->q12 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q12" value="1" {{ $evaluationList->q12 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q13" value="5" {{ $evaluationList->q13 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="4" {{ $evaluationList->q13 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="3" {{ $evaluationList->q13 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="2" {{ $evaluationList->q13 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q13" value="1" {{ $evaluationList->q13 == 1 ? 'checked': '' }}> 1</label>
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
                    <label class="margin-r-5"><input type="radio" name="q14" value="5" {{ $evaluationList->q14 == 5 ? 'checked': '' }}> 5</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="4" {{ $evaluationList->q14 == 4 ? 'checked': '' }}> 4</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="3" {{ $evaluationList->q14 == 3 ? 'checked': '' }}> 3</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="2" {{ $evaluationList->q14 == 2 ? 'checked': '' }}> 2</label>
                    <label class="margin-r-5"><input type="radio" name="q14" value="1" {{ $evaluationList->q14 == 1 ? 'checked': '' }}> 1</label>
                  </div>
                </div>
              </div>
              <!-- r5 -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Comments:</label>
                    <textarea class="form-control" name="comments" id="comments" rows="5" disabled> {{ $evaluationList->comments }}</textarea>
                  </div>
                </div>
              </div>  
              
            <div class="row title-centered">
              <div class="col-sm-6">
                 <h4><b class="left">I. <span class="margin-r-20"></span> Summary of Rating</b></h4><br>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"><b>Score</b></div>
            </div>
      
            <div class="row title-centered">
              <div class="col-sm-6">
                 <h4><b class="left">II. <span class="margin-r-20"></span> Course Planning/Preparation</b></h4><br>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"><b>{{ $evaluationList->totalCoursePlanning() }}</b></div>
            </div>

            <div class="row title-centered">
              <div class="col-sm-6">
                 <h4><b class="left">III. <span class="margin-r-20"></span> Instructional Delivery</b></h4><br>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"><b>{{ $evaluationList->totalInstructionalDelivery() }}</b></div>
            </div>

            <div class="row title-centered">
              <div class="col-sm-6">
                 <h4><b class="left">IV. <span class="margin-r-20"></span> Assessment of Study Learning</b></h4><br>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"><b>{{ $evaluationList->totalAssessment() }}</b></div>
            </div>

            <div class="row title-centered">
              <div class="col-sm-6">
                 <h4><b class="left">V. <span class="margin-r-20"></span> Classroom Management</b></h4><br>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"><b>{{ $evaluationList->totalClassroomManagement() }}</b></div>
            </div>

            <div class="row title-centered">
              <div class="col-sm-6">
                 <h4><b class="left">I. <span class="margin-r-20"></span> Personality and Poise</b></h4><br>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-2"><b>{{ $evaluationList->totalPersonalityandPoise() }}</b></div>
            </div>

            <div class="box-footer" style="text-align: center">
                <button type="button" class="btn btn-lg btn-primary no-print" aria-label="Print" 
                  onclick="$('section.content').printThis();"><i class="fa fa-print"></i> Print
                  </button>
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


@endsection