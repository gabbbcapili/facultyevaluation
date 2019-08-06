$('[name="department_id"]').change(function(){
    $.get("/department/getCourses/"+$(this).val(), function(data, status){
      $('#fg_courses').html(data);
    });
  }); 