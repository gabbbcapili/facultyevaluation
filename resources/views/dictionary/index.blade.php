@extends('layouts.base')
@section('title', 'Dictionary')

@section('content')

   <!-- Content Header (Page header) -->
    <section class="content-header no-print">
      <h1>
        Dictionary
        <small>manage your dictionaries</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Dictionary List</h3>
              <div class="box-tools">
                <div class="btn-group">
                <a href="#" class="btn btn-block btn-primary modal_button" data-href="{{ action('DictionaryController@create') }} "><i class="fa fa-plus"></i> Add Dictionary</a>
              </div>
            </div>
            </div> <!-- /.box-header -->

             <div class="box-body">
              <div class="table-responsive">
              <table id="dictionary-table" class="table table-bordered table-striped datatable">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Word</th>
                  <th class="text-center">Type</th>
                  <th class="text-center">Type</th>
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
  var dictionary_table = $('#dictionary-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('dictionary.index') }}',
        "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
                "searchable": true
            }
        ],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'word', name: 'word' },
            { data: 'editType', name: 'editType' },
            { data: 'type', name: 'type' },
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();

  $('.view_modal').on('hidden.bs.modal', function () {
    dictionary_table.ajax.reload();
  });

  dictionary_table.on("change", ".type", function() {
    var value = $(this).val();
    var id = $(this).data('id');

    $.ajax({
      url : '{{ action('DictionaryController@updateType') }}',
      type : 'GET',
      data: {type : value, id: id},
      success: function(result){
        console.log(result);
        if(result.success == true){
          toastr.success(result.msg);
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
});
 </script>
@endsection