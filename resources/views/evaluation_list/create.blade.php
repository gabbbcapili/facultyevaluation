@extends('layouts.base')
@section('title', 'Create Evaluation List')

@section('content')
<style type="text/css">
	.title-centered{
		font-family: Times New Roman;
		font-size: 20px;
	}
	.border{
		border:1px solid black;
		padding:10px;
	}
</style>
<!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Evaluation
        <small>create evalution</small>
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
				  <div><b>{{ $evaluation->faculty->department ? $evaluation->faculty->department->name : ''  }}</b></div>
            </div> <!-- /.box-header -->
            <div class="box-header title-centered">
            	<div>
            	Faculty Code:
            	<b class="border">123123211</b>	
            	<b class="border">{{ $evaluation->faculty->getFullName() }} </b>
            	</div><br>
            	<div>
            		Date:
            		<b>{{ date_format(today(), 'M d, Y') }}</b>
            	</div><br>
            	<div class="col-sm-6">
            		<div class="form-group">
            			Subject:<input type="text" class="form-control" name="subject">
            		</div>
            	</div>
            	<div class="col-sm-2">
            	</div>
            	<div class="col-sm-4">
            		<div class="form-group">
            			Semester:<input type="text" class="form-control" name="semester">
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
             <div class="box-body">
             	
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