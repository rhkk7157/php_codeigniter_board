<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<h2>List of Pictures</h2>
<?php if(count($count)){
?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>idx</th>
        <th>Thumbnail</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($count as $pic): ?>
        <tr>
          <td><?=$pic->id;?></td>
          <td><a href="<?=base_url().'Upload/gets'."/".$pic->id;?>"><img src="<?=base_url().'uploads/'.$pic->pic_file1;?>" width="100"></a></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <br />
  <a href="<?=base_url().'Upload/insert';?>" class="btn btn-primary">Upload More</a>
<?php } else { ?>
  <h4>No Pictures have been uploaded!. Click this button to <a href="<?=base_url().'Upload/do_upload';?>" class="btn btn-primary">upload</a></h4>
<?php } ?>
<?php echo $links; ?>
