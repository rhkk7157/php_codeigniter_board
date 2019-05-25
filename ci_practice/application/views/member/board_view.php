<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php foreach($pic as $row): ?>
  <form class="" action="<?php echo base_url().'Upload/insert_comment/'.$row->id; ?>" method="post">
    <div id="view">
      <?php echo $row->id; ?>
      <img src="<?php echo base_url().'uploads/'.$row->pic_file1;?>" width="150" alt="">
      <?php echo $row->pic_file1; ?>
    </div><br>
    <div class="">댓글
      <input type="text" name="comment" size="40" value="">
      <input type="submit" name="" value="확인">
    </div>
  <?php endforeach ?>
</form>
<div id="comment">
  <?php if(isset($comment)):?>
    <?php foreach($comment as $re):?>
      <div class="" id="comment_<?php echo $re->idx;?>">
        <?php echo $re->user_id;?>
        <?php echo $re->comment;?>
        <?php echo $re->date; ?>
        <button type="button" name="button" id="btn_repl" onclick="btn_comment(<?php echo $re->idx;?>);">답글</button>
      </div>
</div>
<?php endforeach; ?>
<?php else:?>
<?php endif;?>
<?php echo $links; ?>
<script type="text/javascript">
function btn_comment(idx) { //idx : comment테이블의 idx 댓글번호
  if($("#re_comment_"+idx+"").length == 0) {
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
        alert('다시 시도해주세요');
        // console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
    $("#zone_"+idx).show();
    $('#comment_'+idx).append('<div id="zone_'+idx+'"><table id="list_'+idx+'"><tbody></tbody></table><div id="re_'+idx+'"><input name="re_comment" id="re_comment_'+idx+'" value=""/><button onclick="repl_insert('+idx+');">등록</button></div></div>');
  }else{
    $("#zone_"+idx).toggle();
  }
}

function repl_insert(idx) { //comment 테이블 idx, 대댓글 등록
  var re_comment = $('#re_comment_'+idx).val();
  $.ajax({
    type:"POST",
    url:"<?php echo base_url()?>Upload/re_comment",
    data: {idx:idx,re_comment:re_comment},
    success:function(response){
      alert('등록되었습니다.');
      location.reload();
    },
    error:function(request,status,error){
      alert('다시 시도해주세요');
      // console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }
  });
}
</script>
