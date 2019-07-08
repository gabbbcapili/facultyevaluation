<div class="modal-dialog modal-dialog-centered" role="document">
	<form action="{{ $action }}" method="POST" class="form" enctype='multipart/form-data'>
    @method('DELETE')
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Delete {{ ucfirst($title) }}
		</h4>
	</div>
	<div class="modal-body">
    Are you sure to delete this {{ $title }}?
	</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-danger no-print btn_save"><i class="fa fa-trash"></i> Delete
      </button>
      </form>
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
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
              toastr.error(result.msg);
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