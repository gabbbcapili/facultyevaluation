@if($courses->count() == 0)
	<script type="text/javascript">
		toastr.error('No courses in this department yet.');
	</script>
@endif
<label for="course_id">Course:</label>
	<select class="form-control" name="course_id">
     @if($courses->count() == 0)
     	<option selected value="">No courses in this department yet.</option>
     @else
     	<option hidden selected></option>
     @endif
     @foreach($courses as $course)
     	<option value="{{ $course->id }}">{{ $course->name }}</option>
     @endforeach
</select>