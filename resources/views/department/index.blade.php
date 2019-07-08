@extends('layouts.base')
@section('title', 'Department')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Department
        <small>manage your departments</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Department List</h3>
              <div class="box-tools">
                <div class="btn-group">
                <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('DepartmentController@create') }} "><i class="fa fa-plus"></i> Add Department</a>
              </div>
            </div>
            </div> <!-- /.box-header -->

             <div class="box-body">
              <div class="table-responsive">
              <table id="departments-table" class="table table-bordered table-striped datatable">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Total Students</th>
                  <th class="text-center">Total Faculty</th>
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
  var department_table = $('#departments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('department.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'no_of_students', name: 'no_of_students' },
            { data: 'no_of_faculty', name: 'no_of_faculty' },
            { data: 'action', name: 'action' },
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();

  $('.view_modal').on('hidden.bs.modal', function () {
    department_table.ajax.reload();
  });
});
 </script>
@endsection