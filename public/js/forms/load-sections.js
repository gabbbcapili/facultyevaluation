$('#fg_courses').on('click', '[name="course_id"]', function(){
    $.get("/course/getSections/"+$(this).val(), function(data, status){
      $('#fg_sections').html(data);
    });
  });