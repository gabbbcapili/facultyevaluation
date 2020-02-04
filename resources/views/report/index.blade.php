@extends('layouts.base')
@section('title', 'Evaluation Reports')

@section('content')
 <style type="text/css">
  .select2 {
    width:100%!important;
    color:black;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice { 
    color:black;
   }
 </style>

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Evaluation Reports
        <small>manage your reports</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Filter Reports</h3>
            </div> <!-- /.box-header -->
             <div class="box-body">
                <div class="row">
                  <div class="col-sm-4">
                    <label>Department:</label>
                    <select class="form-control select2 filter" name="department_id">
                      <option value="all" selected>All</option>
                      @foreach($departments as $department)
                        <option value="{{ $department->id }}"> {{ $department->name }} </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-sm-4">
                    <label>Employee:</label>
                    <select class="form-control select2 filter" name="employee_id">
                      <option value="all" selected>All</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                      <label>Start Date:</label>
                      <input type="date" class="form-control filter" name="start_date">
                    </div>

                    <div class="col-sm-4">
                      <label>End Date:</label>
                      <input type="date" class="form-control filter" name="end_date">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>





      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Evaluation Reports List</h3>
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
  function getParams(){

    var param = '?';
    $('.filter').each(function(){
      param += $(this).attr('name') + '=' + $(this).val() + '&';
    });
    return param;
  }
  var evaluation_table = $('#evaluation-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('report.index') }}' + getParams(),
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

  $(".select2").select2();

  $('[name=department_id]').change(function(){
    jQuery.get('getEmployees/'+ this.value, function(data, status){
      jQuery('[name=employee_id]').html(data);
    });
  });

  $('.filter').change(function(){
    evaluation_table.ajax.url('{{ route("report.index") }}' + getParams()).load();
  });
});
 </script>
@endsection