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
        console.log(result);
        if(result.success == true){
          toastr.success(result.msg);
          window.location.href = "/home";
        }else{
          if(result.msg){
            toastr.error(result.msg);
          }
           $('.error').remove();
              $.each(result.error, function(index, val){
              $('#'+ index).after('<label class="text-danger error" style="font-size:14px !important;">' + val + '</label>');
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