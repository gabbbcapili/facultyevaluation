@extends('layouts.base')
@section('title', 'Evaluations')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Evaluations
        <small>manage your evaluations</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evaluation List</h3>
            </div> <!-- /.box-header -->

             <div class="box-body">
              <div class="table-responsive">
                <table id="evaluationlist-table" class="table table-bordered table-striped datatable">
                  <thead>
                  <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Faculty</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Course Planning/Preparation</th>
                    <th class="text-center">Instructional Delivery</th>
                    <th class="text-center">Assessment of Student Learning</th>
                    <th class="text-center">Classroom Management</th>
                    <th class="text-center">Personality Poise</th>
                    <th class="text-center">Comments</th>
                    <th class="text-center">View Actual</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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


@section('javascript')
<script type="text/javascript">
 $( document ).ready(function() {
  var evaluationlist_table = $('#evaluationlist-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ action('EvaluationListController@index') }}',
        columns: [
            { data: 'date', name: 'created_at' },
            { data: 'faculty', name: 'faculty' },
            { data: 'subject', name: 'subject' },
            { data: 'totalCoursePlanning', name: 'totalCoursePlanning' },
            { data: 'totalInstructionalDelivery', name: 'totalInstructionalDelivery' },
            { data: 'totalAssessment', name: 'totalAssessment' },
            { data: 'totalClassroomManagement', name: 'totalClassroomManagement' },
            { data: 'totalPersonalityandPoise', name: 'totalPersonalityandPoise' },
            { data: 'comments', name: 'comments'},
            { data: 'action', name: 'action', orderable : false},
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();
});
 </script>
@endsection