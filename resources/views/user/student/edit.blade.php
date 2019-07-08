<div class="modal-dialog modal-lg" role="document">
	<form action="{{ action('StudentController@update', [$user->id]) }}" method="POST" class="form" enctype='multipart/form-data'>
    @method('PUT')
		@csrf
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Edit Student
		</h4>
	</div>
<div class="modal-body">
    <div class="row">
      <div class="col-sm-4">
          <div class="form-group">
            <label>Department ID:</label>
           <select class="form-control" name="department_id">
             <option hidden selected></option>
             @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
             @endforeach
           </select>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Student ID:</label>
            <input type="text" class="form-control" value="{{ $user->student_id }}" disabled>
          </div>
        </div>
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