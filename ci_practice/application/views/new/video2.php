<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>`enter code here`


This is my HTML for video





<label for="select video">Select video/Multiple videos</label>
<video id='my-video' class='video-js' controls preload='auto' width='400' height=450
data-setup='{}'   controls preload="auto">
<source  src="<?php echo base_url() ?>Uploads/KakaoTalk_Video_20190412_1125_39_755.mp4"  id="video_here">
  Your browser does not support HTML video.
</video>

Here is my input type which contains the the file type for selecting files and here i include an attribute multiple for selecting multiple files
<input type="file" multiple />

<!-- <video id='my-video' class='video-js' controls preload='auto' width='400' height=450
data-setup='{}'   controls preload="auto">
<source  src="<?php echo base_url() ?>Uploads/KakaoTalk_Video_20190412_1125_39_755.mp4"  id="video_here">
</video> -->
<script>

document.querySelector("input[type=file]")
.onchange = function(event) {
  var files = event.target.files;
  for (var i = 0; i < files.length; i++) {
    var f = files[i];
    // Only process video files.
    if (!f.type.match('video.*')) {
      continue;
    }
    var source = document.createElement('video'); //added now
    // var source = video.createElement('source'); //added now

    source.className='vjs-tech';

    source.width = 400;

    source.height = 450;

    source.controls = true;

    source.src = URL.createObjectURL(files[i]);


    document.body.appendChild(source); // append `<video>` element

  }
}

</script>

<link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">
<script src='https://vjs.zencdn.net/7.4.1/video.js'></script>
<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
</head>
<style>
#video_canvas{
  margin-top:10px;
  margin-right:auto;
  margin-left:auto;
  margin-bottom:0px;
  width:320px;
  height:auto;

}

</style>
