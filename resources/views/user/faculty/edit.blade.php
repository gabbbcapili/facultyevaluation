 @inject('request', 'Illuminate\Http\Request')
 <style type="text/css">
  .select2 {
    width:100%!important;
    color:black;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice { 
    color:black;
   }
 </style>
<div class="modal-dialog modal-lg" role="document">
	<form action="{{ action('FacultyController@update', [$user->id]) }}" method="POST" class="form" enctype='multipart/form-data'>
    @method('PUT')
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Edit Faculty
		</h4>
	</div>
<div class="modal-body">
    <div class="row">
      @if($request->user()->isAdmin())
      <div class="col-sm-4">
          <div class="form-group">
            <label>Department:</label>
           <select class="form-control" name="department_id">
             <option hidden selected></option>
             @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
             @endforeach
           </select>
          </div>
        </div>
        @else
          <input type="hidden" name="department_id" value="{{ $request->user()->department_id }}">
        @endif
        <div class="col-sm-4">
          <div class="form-group">
           <label>Role:</label>
           <select class="form-control" disabled>
             <option hidden selected></option>
             <option value="faculty" {{ $user->role == 'faculty' ? 'selected' : '' }}>Faculty</option>
             <option value="secretary" {{ $user->role == 'secretary' ? 'selected' : '' }}>Secretary</option>
             <option value="dean" {{ $user->role == 'dean' ? 'selected' : '' }}>Dean</option>
           </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Faculty ID:</label>
            <input type="text" class="form-control" value="{{ $user->faculty_id }}" disabled>
          </div>
        </div>
        @if($user->role == 'faculty')
          <div class="col-sm-8">
            <div class="form-group">
              <label>Subjects:</label><br>
              <select class="form-control" id="subjects" multiple name="subjects[]">
               @foreach($subjects as $subject)
                <option value="{{ $subject->id }}"{{ in_array($subject->id, explode(',', $user->subjects)) ? 'selected' : '' }}>{{ $subject->name }}</option>
               @endforeach
              </select>
            </div>
          </div>
       @endif
    </div>



    
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>First Name:</label>
          <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Middle Name:</label>
          <input type="text" name="middle_name" class="form-control" value="{{ $user->middle_name }}">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Last Name:</label>
          <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" class="form-control" value="{{ $user->email }}">
          </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
          <label>Contact Number:</label>
          <input type="text" name="contact_number" class="form-control" value="{{ $user->contact_number }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Birth Date:</label>
          <input type="date" name="bday" class="form-control" value="{{ $user->bday }}">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Gender:</label>
         <select class="form-control" name="gender">
           <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
           <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
         </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Civil Status:</label>
          <select class="form-control" name="civil_status">
            @foreach($civil_statuses as $civil_status)
                <option value="{{ $civil_status }}" {{ $user->civil_status == $civil_status ? 'selected' : '' }}>{{ $civil_status }}</option>
            @endforeach
          </select>
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
  $(document).ready(function() {
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};
    $("#subjects").select2({
      placeholder: 'Select Subjects',
    });
  });
</script>
<script src="{{ asset('js/forms/form-modal.js') }}"></script>