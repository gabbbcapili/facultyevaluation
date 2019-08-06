<div class="modal-dialog modal-lg" role="document">
	<form action="{{ action('StudentController@store') }}" method="POST" class="form" enctype='multipart/form-data'>
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Add Student
		</h4>
	</div>
	<div class="modal-body">
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
          <div class="form-group" id="fg_courses">
            <label for="course_id">Course:</label>
            <select class="form-control" name="course_id">
                 <option hidden selected></option>
               </select>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group" id="fg_sections">
            <label for="section_id">Section:</label>
            <select class="form-control" name="section_id">
                 <option hidden selected></option>
               </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Student ID:</label>
            <input type="text" name="student_id" class="form-control">
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>First Name:</label>
          <input type="text" name="first_name" class="form-control">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Middle Name:</label>
          <input type="text" name="middle_name" class="form-control">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Last Name:</label>
          <input type="text" name="last_name" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" class="form-control">
          </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
          <label>Contact Number:</label>
          <input type="text" name="contact_number" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Birth Date:</label>
          <input type="date" name="bday" class="form-control">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Gender:</label>
         <select class="form-control" name="gender">
           <option value="Male">Male</option>
           <option value="Female">Female</option>
         </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Civil Status:</label>
          <select class="form-control" name="civil_status">
            @foreach($civil_statuses as $civil_status)
                <option value="{{ $civil_status }}">{{ $civil_status }}</option>
            @endforeach
          </select>
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
<script src="{{ asset('js/forms/load-courses.js') }}"></script>
<script src="{{ asset('js/forms/load-sections.js') }}"></script>
<script src="{{ asset('js/forms/form-modal.js') }}"></script>