<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  	<div class="modal-header">
		<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="modalTitle">Evaluation for {{ $evaluation->faculty->getFullName() }}  - {{ App\Utilities::format_date($evaluation->start_date, 'M d, Y') }} 
		</h4>
	</div>
	<div class="modal-body">
		<div class="box-body">
      <div class="table-responsive">
        <table id="evaluationlist-table" class="table table-bordered table-striped datatable">
          <thead>
          <tr>
            <th class="text-center">Date</th>
            <th class="text-center">Subject</th>
            <th class="text-center">Comments</th>
            <th class="text-center">Total Comments</th>
            <th class="text-center">Course Planning/Preparation</th>
            <th class="text-center">Instructional Delivery</th>
            <th class="text-center">Assessment of Student Learning</th>
            <th class="text-center">Classroom Management</th>
            <th class="text-center">Personality Poise</th>
            <th class="text-center">View Actual</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
	</div>
    <div class="modal-footer">
    <!--   <button type="button" class="btn btn-primary no-print" aria-label="Print" 
      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> Print
      </button> -->
      <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>


<script type="text/javascript">
 $( document ).ready(function() {
  var evaluationlist_table = $('#evaluationlist-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ action('EvaluationController@getEvaluationList', [$evaluation->id]) }}',
        columns: [
            {data: 'date', name: 'created_at'},
            { data: 'subjectclass', name: 'subjectclass.name' },
            { data: 'comments', name: 'comments'},
            { data: 'commentsTotals', name: 'commentsTotals'},
            { data: 'totalCoursePlanning', name: 'totalCoursePlanning' },
            { data: 'totalInstructionalDelivery', name: 'totalInstructionalDelivery' },
            { data: 'totalAssessment', name: 'totalAssessment' },
            { data: 'totalClassroomManagement', name: 'totalClassroomManagement' },
            { data: 'totalPersonalityandPoise', name: 'totalPersonalityandPoise' },
            { data: 'action', name: 'action', orderable : false},
        ]
    });
  $('[data-toggle="tooltip"]').tooltip();
});
 </script>