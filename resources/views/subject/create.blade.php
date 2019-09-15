<div class="modal-dialog modal-lg" role="document">
	<form action="{{ action('SubjectController@store') }}" method="POST" class="form" enctype='multipart/form-data'>
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Add Subject
		</h4>
	</div>
	<div class="modal-body" >
	  <div class="row">
	    <div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="phone_no">Subject Name:</label>
	    		<input type="text" name="name" class="form-control">
	    	</div>
	    </div>
	  </div>
	</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary no-print btn_save"><i class="fa fa-save"></i> Save
      </button>
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
  </div>
  </form>
</div>

<script src="{{ asset('js/forms/form-modal.js') }}"></script>