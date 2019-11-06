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
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="modalTitle">View Faculty
    </h4>
  </div>
<div class="modal-body">
    <div class="row">
      <div class="col-sm-4">
          <div class="form-group">
            <label>Faculty ID: </label> {{ $user->faculty_id }}
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Department:</label> {{ $user->department->name }}
          </div>
        </div>
      </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Full Name: </label>{{ $user->getFullName() }}
        </div>
      </div>
    </div>
    <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Subjects: 
              </label>@foreach(\App\Subject::whereIn('id', explode(',', $user->subjects))->get() as $subject)
                  {{ $subject->name }}, 
                @endforeach
            </div>
          </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Email: </label>{{ $user->email }}
          </div>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
          <label>Contact Number: </label>{{ $user->contact_number }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Birth Date:</label> {{ $user->bday }}
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Gender:</label> {{ $user->gender }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <b><h4>Total Dictionary Evaluation:</h4></b>
      </div>
      <div class="col-sm-12">
        @foreach($totals as $key => $value)
        <label> {{ ucfirst($key) }} : </label> {{ $value }}<br>
        @endforeach
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <b><h4>Top 5 Used Words on Evaluation:</h4></b>
      </div>
      <div class="col-sm-12">
        @foreach($words as $key => $value)
          @if($loop->iteration <= 5)
            <label> {{ ucfirst($key) }} : </label> {{ $value }} times used. (<b> {{ \App\Dictionary::where('word', $key)->first() ? \App\Dictionary::where('word', $key)->first()->type : '' }} </b>)<br>
          @endif
        @endforeach
      </div>
    </div>
  </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
  </div>
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