<option value="all" selected>All</option>
@foreach($employees as $employee)
<option value="{{ $employee->id }}">{{ $employee->getFullName() }}</option>
@endforeach