<div class="modal-dialog modal-xl" role="document">
	<form action="{{ action('UserController@changePasswordUpdate') }}" class="form" method="POST" enctype="multipart/form-data">
	@method('put')
		@csrf	
  <div class="modal-content">
    <div class="modal-header">
	    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    <h4 class="modal-title" id="modalTitle"> User - Change Password
	    </h4>
	</div>
		<div class="modal-body" >
		 <div class="row invoice-info">
		    <div class="col-sm-4 invoice-col">
		      <div class="form-group">
		      	<label for="payment">Current Password:</label>
		      	<input type="password" name="CurrentPassword" id="CurrentPassword" class="form-control">		      		
		      </div>
		    </div>
		  </div>
		  <div class="row invoice-info">
		    <div class="col-sm-4 invoice-col">
		      <div class="form-group">
		      	<label for="payment">New Password:</label>
		      	<input type="password" name="NewPassword" id="NewPassword" class="form-control">		      		
		      </div>
		    </div>
		    <div class="col-sm-4 invoice-col">
		      <div class="form-group">
		      	<label for="payment">Confirm Password:</label>
		      	<input type="password" name="ConfirmPassword" id="ConfirmPassword" class="form-control">		      		
		      </div>
		    </div>
		  </div>
		</div>
    <div class="modal-footer">
      <button class="btn btn-primary no-print" type="submit" class="btn_save"><i class="fa fa-save"></i> Save
      </button>
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
</form>
  </div>
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
          error: function(jqXhr, json, errorThrown, result){
            console.log(jqXhr);
            console.log(json);
            console.log(errorThrown);
            $('.btn_save').prop('disabled', false);
          }
      });
  });
</script>
