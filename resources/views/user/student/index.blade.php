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
              <h3 class="box-title">Users List</h3>
            </div> <!-- /.box-header -->

             <div class="box-body">
              <div class="table-responsive">
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Student ID</th>
                  <th class="text-center">Full name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Created At</th>
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
  $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('student.index') }}',
        columns: [
            { data: 'student_id', name: 'student_id' },
            { data: 'full_name', name: 'full_name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
        ]
    });
});
 </script>
@endsection
