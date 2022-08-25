$(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 

        console.log("YES");
         
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '/changeStatus',
            headers: {
              'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            },
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
