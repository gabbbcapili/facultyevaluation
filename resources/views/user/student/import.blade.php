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
              <h3 class="box-title">Import CSV file only</h3>
              <hr>
            </div> <!-- /.box-header -->
             <div class="box-body">
             <h4>  <p>The first line in downloaded csv file should remain as it is. Please do not change the order of columns in csv file.</p>
               The correct column order is
             (
               @foreach($headers as $header) 
               {{ $header }} @if(! $loop->last) , @endif
               @endforeach 
             ) 
           and you must follow the csv file, otherwise you will get an error while importing the csv file.</h4>
               <br>
               <a href="{{ action('StudentController@getCSV') }}" class="btn btn-info"><i class="fa fa-download"></i> DOWNLOAD SAMPLE FILE</a><br><br>
               <form action="{{ action('StudentController@postImport') }}" method="POST" class="form" enctype='multipart/form-data'>
                  @csrf
                 <div class="row">
                   <div class="col-sm-4">
                     <div class="form-group">
                       <label>Department:</label>
                       <select class="form-control" name="department_id">
                        <option hidden selected></option>
                        @foreach($departments as $department)
                           <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                       </select>
                     </div>
                   </div>
                   <div class="col-sm-4">
                     <div class="form-group">
                       <label>Upload File:</label>
                       <input type="file" name="file" class="form-control">
                       <p class="help-block">Please select csv file (allowed file size 2MB)</p>
                     </div>
                   </div>
                 </div>
                 <div class="box-footer">
                     <button type="submit" class="btn btn-primary btn_save">Submit</button>
                   </div>
               </form>
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
  $(".form").submit(function(e) {
  e.preventDefault();
   $('.btn_save').prop('disabled', true);
    $.ajax({
      url : $(this).attr('action'),
      type : 'POST',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(result){
        if(result.success == true){
          toastr.success(result.msg);
          $('.form')[0].reset();
        }else{
          if(result.msg){
            toastr.error(result.msg);
          }
           $('.error').remove();
              $.each(result.error, function(index, val){
              $('[name="'+ index +'"]').after('<label class="text-danger error">' + val + '</label>');
              });
        }
        $('.btn_save').prop('disabled', false);
         },
        error: function(jqXhr, json, errorThrown){
          console.log(jqXhr);
          console.log(json);
          console.log(errorThrown);
          $('.btn_save').prop('disabled', false);
        }
    });
});
</script>
@endsection
