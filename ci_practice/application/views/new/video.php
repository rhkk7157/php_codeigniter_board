<input type="file" id="myFile" accept=".jpg,.jpeg.,.gif,.png,.mov,.mp4"  multiple/>

<p><strong>Select a video or image file</strong><br /><br />Supported browsers (tested): Chrome, Firefox, Safari, Opera, IE10, IE11, Android (Chrome), iOS Safari (10+)</p>

<div></div>

<style>

div {
  line-height: 100px;
}

img {
  max-width: 200px;
  max-height: 200px;
  padding: 5px;
  vertical-align: middle;
  text-align: center;
}

@supports (object-fit: cover) {
  img {
    width: 200px;
    height: 200px;
    object-fit: cover;
  }
}

</style>

<script>

document.getElementsByTagName('input')[0].addEventListener('change', function(event) {
  var x = document.getElementById("myFile");
  var file = event.target.files[0];
  var fileReader = new FileReader();
  if (file.type.match('image')) {

  } else {
    fileReader.onload = function() {

      var blob = new Blob([fileReader.result], {type: file.type});
      var url = URL.createObjectURL(blob);
      var video = document.createElement('video');
      var timeupdate = function() {
        if (snapImage()) {
          video.removeEventListener('timeupdate', timeupdate);
          video.pause();
        }
      };
      video.addEventListener('loadeddata', function() {
        if (snapImage()) {
          video.removeEventListener('timeupdate', timeupdate);
        }
      });
      var snapImage = function() {
          // alert(x.files.item(i));
          var canvas = document.createElement('canvas');
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

        var image = canvas.toDataURL();
        var success = image.length > 100000;
        if (success) {
          for(var i=0;i<x.files.length;i++){
            var img = document.createElement('img');
            img.src = image;
            document.getElementsByTagName('div')[0].appendChild(img);
          }
          URL.revokeObjectURL(url);
        }
        return success;
      };
      video.addEventListener('timeupdate', timeupdate);
      video.preload = 'metadata';
      video.src = url;
      // Load video in Safari / IE11
      video.muted = true;
      video.playsInline = true;
      video.play();
    };
    fileReader.readAsArrayBuffer(file);
  }
});


</script>
