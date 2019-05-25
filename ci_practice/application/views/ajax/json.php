<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <form class="" action="index.html" method="post">
    <input type="text" name="" value="">

  </form>
</body>
</html>
<script type="text/javascript">
function fetch_data() {
  $.ajax({
    type:"POST",
    url:"<?php echo base_url()?>Upload/fetch_c_idx",
    dataType:'json',
    data: {c_idx:idx},
    success:function(response){
      $.each(response, function (key, val) {
        $('#list_'+idx+' > tbody:last').append('<tr><td>'+val.user_id+'</td><td>'+val.re_comment+'</td><td>'+val.date+'</td></tr>');
      });
    },
    error:function(request,status,error){
      console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
</script>
