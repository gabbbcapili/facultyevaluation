@extends('layouts.base')
@section('title', 'Course')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Course
        <small>manage your courses</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Course List</h3>
              <div class="box-tools">
                <div class="btn-group">
                <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('CourseController@create') }} "><i class="fa fa-plus"></i> Add Course</a>
              </div>
            </div>
            </div> <!-- /.box-header -->

             <div class="box-body">
              <div class="table-responsive">
              <table id="courses-table" class="table table-bordered table-striped datatable">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Department</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Total Students</th>
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
  var courses_table = $('#courses-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('course.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'department', name: 'department.name' },
            { data: 'name', name: 'name' },
            { data: 'no_of_students', name: 'no_of_students' },
            { data: 'action', name: 'action', orderable : false},
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();

  $('.view_modal').on('hidden.bs.modal', function () {
    courses_table.ajax.reload();
  });
});
 </script>
@endsection