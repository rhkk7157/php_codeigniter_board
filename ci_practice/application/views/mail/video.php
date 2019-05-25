<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script>
      // 마우스 진입 이벤트
      $(document).on('mouseenter', '.preview_div', function(){
        // 재생 버튼 감추기
        $(this).find('img').hide();
        // 썸네일 이미지를  gif 이미지로 변경
        $(this).css('background-image', 'url(https://t1.daumcdn.net/cfile/tistory/99D4F34B5BE6C2CE01?v='+Math.random()+')');
      });
      // 마우스 아웃 이벤트
      $(document).on('mouseleave', '.preview_div', function(){
        // 재생 버튼 보아기
        $(this).find('img').show();
        // gif 이미지를  썸네일 이미지로 변경
        $(this).css('background-image', 'url(https://t1.daumcdn.net/cfile/tistory/99AEF8505BE6BF582D)');
      });
    </script>
    <style type="text/css">
      .preview_div { line-height: 240px; width: 430px; height: 240px; text-align: center;
        cursor: pointer;
        background-repeat: no-repeat;
        background-size: 100%;
        background-image: url(http://cfile21.uf.tistory.com/image/99AEF8505BE6BF582D6347);}
      .preview_div > img {width: 80px; vertical-align: middle;}
    </style>
  </head>
  <body>
    <!-- 미리보기 td -->
    <div class='preview_div'>
      &nbsp;<img src='https://t1.daumcdn.net/cfile/tistory/99AADD435BE6C39504' alt="preview_img"/>&nbsp;
    </div>
  </body>
</html>
