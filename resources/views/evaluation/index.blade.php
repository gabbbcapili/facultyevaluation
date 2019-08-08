@extends('layouts.base')
@section('title', 'Evaluation')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Evaluation
        <small>manage your courses</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evaluation List</h3>
              <div class="box-tools">
                <div class="btn-group">
                <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('EvaluationController@create') }} "><i class="fa fa-plus"></i> Add Evaluation</a>
              </div>
            </div>
            </div> <!-- /.box-header -->

             <div class="box-body">
              <div class="table-responsive">
              <table id="evaluation-table" class="table table-bordered table-striped datatable">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Department</th>
                  <th class="text-center">Faculty ID</th>
                  <th class="text-center">Faculty Name</th>
                  <th class="text-center">Start Date</th>
                  <th class="text-center">End Date</th>
                  <th class="text-center">Action</th>
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
  var evaluation_table = $('#evaluation-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('evaluation.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'department', name: 'department.name' },
            { data: 'faculty_id', name: 'faculty_id' },
            { data: 'faculty', name: 'faculty.faculty_id'},
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'action', name: 'action', orderable : false},
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();

  $('.view_modal').on('hidden.bs.modal', function () {
    evaluation_table.ajax.reload();
  });
});
 </script>
@endsection