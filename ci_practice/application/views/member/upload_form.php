<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<html>
<head>
  <title>Upload Form</title>
</head>
<style media="screen">
/* #image_preview{
  display:none;
  width : 250px;
  height : 250px;
}

.file_input_textbox {
  float:left;
  height:29px;
}
.file_input_div {
  position:relative;
  width:50px;
  height:40px;
  overflow:hidden;
}
.file_input_img_btn {
  padding:0 0 0 5px;
}
.file_input_hidden {
  font-size:29px;
  position:absolute;
  right:0px;
  top:0px;
  opacity:0;
  filter: alpha(opacity=0);
  -ms-filter: alpha(opacity=0);
  cursor:pointer;
} */

.imgs_wrap {
  width:600px;
  margin-top:50px;
}
.imgs_wrap img {
  max-width:200px;
}
</style>
<body>
  <?php echo $error;?>

  <?php echo form_open_multipart('upload/upload_file');?>
  <input type="file" name="multipleFiles[]" id="image-source" multiple onchange="file_1();"/><br /><br>

<!-- 이미지 2
 <input type="file" name="" value=""> -->
  <!-- <input type="file" name="multipleFiles[]" id="image-source" onchange="previewImage();" multiple/> -->
  <!-- <img id="image_preview" alt="image preview"> img preview 1개-->
  <div class="">
    <div class="imgs_wrap"></div>
  </div>
  <input type="submit" value="upload"/>
  <br/><br/>
<!-- 파일선택 다른 이미지로 바꿈-->
 <!-- 이미지업로드 <input type="hidden" id="fileName" class="file_input_textbox" readonly>
  <div class="file_input_div">
    <img src="../uploads/images3.png" class="file_input_img_btn" alt="open" style="width:70px;height:100px;"/>
    <input type="file" name="file_1" class="file_input_hidden" onchange="javascript: document.getElementById('fileName').value = this.value"/>
  </div> -->
</form>
</body>
</html>
<script type="text/javascript">
var sel_files = [];
$(document).ready(function() {
  $("#image-source").on("change",handleImgsFilesSelect);
});

function handleImgsFilesSelect(e) {
  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);

  var index = 0;
  filesArr.forEach(function(f) {
    // if(!f.type.match("image.*")) {
    //   alert("확장자는 이미지만 가능합니다.");
    //   return;
    // }
    sel_files.push(f);
    var reader = new FileReader();
    reader.onload = function(e) {
      var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\""+e.target.result+"\" data-file='"+f.name+"' class='selProductFile' title='삭제'/></a>";

      // var img_html = "<a href='#' onclick='img_del();'><img src=\""+e.target.result+"\" / /></a>";
      $(".imgs_wrap").append(html);
      index++;
    }
      reader.readAsDataURL(f);
  });
}

function deleteImageAction(index) {
alert(index);
  if(confirm('삭제하시겠습니까?') == false) {
    return false;
  }else{
    sel_files.splice(index,1);
    $("#img_id_"+index).remove();
  }
  // console.log(sel_files);
}

function file_1() {
  $("input[type=file]").change(function () {
    var fileInput = document.getElementById("image-source");
    var files = fileInput.files;
    var file;
    for (var i = 0; i < files.length; i++) {
      file = files[i];
      // alert(file.name);
    }
  });
}



// function previewImage() {  //img preview 1개
//   document.getElementById("image_preview").style.display = "block";
//   var oFReader = new FileReader();
//   oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
//   oFReader.onload = function(oFREvent) {
//     document.getElementById("image_preview").src = oFREvent.target.result;
//   };
// };


</script>
