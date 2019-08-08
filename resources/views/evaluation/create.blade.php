@inject('request', 'Illuminate\Http\Request')
<div class="modal-dialog modal-lg" role="document">
	<form action="{{ action('EvaluationController@store') }}" method="POST" class="form" enctype='multipart/form-data'>
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Add Evaluation
		</h4>
	</div>
	<div class="modal-body">
		@if($request->user()->isAdmin())
	  <div class="row">
	  	<div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="phone_no">Department:</label>
	    		<select class="form-control" name="department_id">
	             <option hidden selected></option>
	             @foreach($departments as $department)
	                <option value="{{ $department->id }}">{{ $department->name }}</option>
	             @endforeach
	           </select>
	    	</div>
	    </div>
	</div>
	@else
		<input type="hidden" name="department_id" value="{{ $request->user()->department_id }}">
	@endif
	<div class="row">
	    <div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="phone_no">Start date:</label>
	    		<input type="date" name="start_date" class="form-control">
	    	</div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="phone_no">End date:</label>
	    		<input type="date" name="end_date" class="form-control">
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