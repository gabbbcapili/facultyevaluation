@if($sections->count() == 0)
	<script type="text/javascript">
		toastr.error('No sections in this course yet.');
	</script>
@endif
<label for="section_id">Section:</label>
	<select class="form-control" name="section_id">
     @if($sections->count() == 0)
     	<option selected value="">No sections in this course yet.</option>
     @else
     	<option hidden selected></option>
     @endif
     @foreach($sections as $section)
     	<option value="{{ $section->id }}">{{ $section->name }}</option>
     @endforeach
</select>