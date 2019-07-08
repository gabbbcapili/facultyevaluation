<div class="modal-dialog modal-xl" role="document">
	<form action="{{ action('DepartmentController@update', $department->id) }}" method="POST" class="form" enctype='multipart/form-data'>
    @method('PUT')
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Edit Department
		</h4>
	</div>
	<div class="modal-body" >
	  <div class="row">
	    <div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="phone_no">Department Name:</label>
	    		<input type="text" name="name" class="form-control" value="{{ $department->name }}">
	    	</div>
	    </div>
	  </div>
	</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary no-print btn_save"><i class="fa fa-save"></i> Update
      </button> 
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
  </div>
  </form>
</div>

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
            $('.view_modal').modal('toggle');
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