<?php

class Mail extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
  }

  public function index() {
    $this->load->view('mail/mail_view');
  }

  public function helpmail(){

      require '../PHPMailer/PHPMailerAutoload.php';
      $email = $this->input->post('email');

      $to = $email;


      $mail = new PHPMailer(true);

      $mail->IsSMTP();

      try {

        //메일서버나 인증에관련된 내용

        $mail->Host = "smtp.gmail.com";  // 메일서버 주소

        $mail->SMTPAuth = true; // SMTP 인증을 사용함

        $mail->Port = 465;    // email 보낼때 사용할 포트를 지정

        $mail->SMTPSecure = "ssl";  // SSL을 사용함

        $mail->Username = "gmbplatformio";  // 계정  [ ??? =메일주소 @앞부분]

        $mail->Password ="test!@gmb"; // 패스워드         [ ??? =  계정 패스워드 ]

        $mail->CharSet = 'utf-8';

        $mail->Encoding = "base64";



        //실제 메일에 관련된내용

        $mail->From="gmbplatformio@gmail.com"; // 메일보내는사람 메일주소

        $mail->FromName= "TravelSpace"; //보내는사람 이름

        // 받는사람메일주소 , 받는사람이름

        $mail->AddAddress($email);

        $mail->Subject = "[travelSpace] 가입을 축하 드립니다."; // 메일 제목

        $mail->MsgHTML("
        <!doctype html>
        <html lang='ko'>
        <head>
        <meta charset='utf-8'>
        <title>[travelspace] 가입을 축하 드립니다.</title>
        </head>

        <body>

        <div style='margin:30px auto;width:600px;border:10px solid #f7f7f7'>
        <div style='border:1px solid #dedede'>
        <h1 style='padding:30px 30px 0;background:#f7f7f7;color:#555;font-size:1.4em'>
        회원가입을 축하드립니다.
        </h1>
        <span style='display:block;padding:10px 30px 30px;background:#f7f7f7;text-align:right'>
        <a href='' target='_blank'></a>
        </span>
        <p style='margin:20px 0 0;padding:30px 30px 50px;min-height:200px;height:auto !important;height:200px;border-bottom:1px solid #eee'>
        <b>
        TravelSpace의 회원가입을 축하드립니다.<br>
        관심 가져 주셔서 감사드립니다.<br><br>
        <span style='font-weight:bold;font-color:navy;'>메일 인증 확인</span></a><br><br> <strong>메일 인증</strong>을 완료 하시고 사이트 이용을 원활히 하시기 바랍니다.<br><?php } ?>

        </p>
        <a href='' target='_blank' style='display:block;padding:30px 0;background:#484848;color:#fff;text-decoration:none;text-align:center'>Travel space</a>
        </div>
        </div>

        </body>
        </html>"



      ); // 메일 내용

      $mail->Send(); // 실제로 메일을 보냄



    } catch (phpmailerException $e) {

      echo $e->errorMessage();

    } catch (Exception $e) {

      echo $e->getMessage();

    }
  }

}
?>
