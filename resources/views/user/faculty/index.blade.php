@extends('layouts.base')
@section('title', 'Faculties')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Faculties
        <small>manage your faculties</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Faculties List</h3>
                <div class="box-tools">
                  <div class="btn-group">
                  <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('FacultyController@create') }} "><i class="fa fa-plus"></i> Add Faculty</a>
                </div>
              </div>
            </div> <!-- /.box-header -->
             <div class="box-body">
              <div class="table-responsive">
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">Faculty ID</th>
                  <th class="text-center">Department</th>
                  <th class="text-center">Full name</th>
                  <th class="text-center">Username</th>
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
  var faculty_table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('faculty.index') }}',
        columns: [
            { data: 'faculty_id', name: 'faculty_id' },
            { data: 'department', name: 'department.name' },
            { data: 'full_name', name: 'full_name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'gender', name: 'gender' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'action', name: 'action' },
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();

  $('.view_modal').on('hidden.bs.modal', function () {
    faculty_table.ajax.reload();
  });
});
 </script>
@endsection
