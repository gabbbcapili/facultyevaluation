<div class="modal-dialog modal-xl" role="document">
	<form action="{{ action('ContactController@store') }}" method="POST" id="contactForm">
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Add Contact
		</h4>
	</div>
	<div class="modal-body" >
	  <div class="row">
	    <div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="name">Name:</label>
	    		<input type="text" name="name" id="name" class="form-control">
	    	</div>
	    	<div class="form-group">
	    		<label for="phone_no">Phone Number:</label>
	    		<input type="text" name="phone_no" id="phone_no" class="form-control">
	    	</div>
	    </div>
	  </div>
	</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary no-print btn_save"><i class="fa fa-save"></i> Save
      </button>
      </form>
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>


<script type="text/javascript">
	$("#contactForm").submit(function(e) {
		e.preventDefault();
		 $('.btn_save').prop('disabled', true);
			window.swal({
				  title: "Checking...",
				  text: "Please wait",
			//	  imageUrl: "images/ajaxloader.gif",
				  button: false,
				  allowOutsideClick: false
				});
		// console.log($(this).serialize());
			$.ajax({
				url : $(this).attr('action'),
				type : 'POST',
				data : $(this).serialize(),
				success: function(data){
					if (data.success){
						console.log(data.success);
						//temporary, it should be $(this).reload(); 
						window.location.replace("{{ action('ContactController@index') }}");
					}
			        if (data.error){
			        	console.log(data.error);
			        	// console.log(data.error);
			        	$('.error').remove();
			        	$.each(data.error, function(index, val){
			        		//console.log(index + '\n' + val)
			        	$('input[id="'+ index +'"]').after('<label class="text-danger error">' + val + '</label>');
			        	$('select[id="'+ index +'"]').after('<label class="text-danger error">' + val + '</label>');
			        	});
			        }
			        setTimeout(() => {
						  window.swal({
						    title: "Something's not right..",
						    button: false,
						    timer: 1000
						  });
						}, 500);
			      	 $('.btn_save').prop('disabled', false);
			        // success logic
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
