@extends('layouts.base')
@section('title', 'Students')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Students
        <small>manage your students</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Students List</h3>
                <div class="box-tools">
                  <div class="btn-group">
                  <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('StudentController@create') }} "><i class="fa fa-plus"></i> Add Student</a>
                </div>
              </div>
            </div> <!-- /.box-header -->
             <div class="box-body">
              <div class="table-responsive">
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Student ID</th>
                  <th class="text-center">Department</th>
                  <th class="text-center">Course</th>
                  <th class="text-center">Section</th>
                  <th class="text-center">Full name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Gender</th>
                  <th class="text-center">Contact Number</th>
                  <th>Action</th>
                </tr>
                </thead>
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
  var student_table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('student.index') }}',
        columns: [
            { data: 'student_id', name: 'student_id' },
            { data: 'department', name: 'department.name' },
            { data: 'course', name: 'course.name' },
            { data: 'section', name: 'section.name' },
            { data: 'full_name', name: 'full_name' },
            { data: 'email', name: 'email' },
            { data: 'gender', name: 'gender' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'action', name: 'action', orderable : false},
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();

  $('.view_modal').on('hidden.bs.modal', function () {
    student_table.ajax.reload();
  });
});
 </script>
@endsection
