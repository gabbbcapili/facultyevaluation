<div class="modal-dialog modal-xl" role="document">
	<form action="{{ action('SectionController@update', $section->id) }}" method="POST" class="form" enctype='multipart/form-data'>
    @method('PUT')
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Edit Section
		</h4>
	</div>
	<div class="modal-body" >
	  <div class="row">
	  	<div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="phone_no">Department:</label>
	    		<select class="form-control" name="department_id">
	             <option hidden selected></option>
	             @foreach($departments as $department)
	                <option value="{{ $department->id }}" {{ $department->id == $section->course->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
	             @endforeach
	           </select>
	    	</div>
	    </div>
	  	<div class="col-sm-6">
	    	<div class="form-group" id="fg_courses">
	    		<label for="course_id">Course:</label>
	    		<select class="form-control" name="course_id">
	             <option hidden selected></option>
	             @foreach($section->course->department->courses as $course)
	                <option value="{{ $course->id }}" {{ $course->id == $section->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
	             @endforeach
	           </select>
	    	</div>
	    </div>
	    <div class="col-sm-6">
	    	<div class="form-group">
	    		<label for="name">Section Name:</label>
	    		<input type="text" name="name" class="form-control" value="{{ $section->name }}">
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
<script src="{{ asset('js/forms/load-courses.js') }}"></script>
<script src="{{ asset('js/forms/form-modal.js') }}"></script>