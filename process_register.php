<?php
include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
try {
  $URL = "http://$_SERVER[HTTP_HOST]".dirname($_SERVER['REQUEST_URI'])."/verify.php";

  $user_fullname = $conn->real_escape_string($_POST['user_fullname']);
  $user_email = $conn->real_escape_string($_POST['user_email']);
  $token = md5(rand().time());
  
  $mail->SMTPDebug = 0;
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'pongpairoch.pongpairoch@gmail.com';
  $mail->Password   = 'kkb123456789';
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;

  $mail->setFrom('pongpairoch.pongpairoch@gmail.com', 'ระบบตลาดกลางอาหารสัตว์เลี้ยง');
  $mail->addAddress($user_email, $user_fullname);

  $mail->isHTML(true);
  $mail->Subject = 'โปรดยืนยันตัวตนของสมาชิก';

  $content = "สวัสดี, ".$user_fullname."<br/>";
  $content .= "โปรดยืนยันตัวตนของสมาชิก<br/>";
  $content .= "ตั้งค่าข้อมูลส่วนตัว ที่ลิงค์ต่อไปนี้ <a href=\"$URL?token=$token\">คลิกที่นี่ </a><br/>";
  $content .= "หรือคัดลอก / วางลิงค์นี้ลงในเบราว์เซอร์ของคุณ: <br/>";
  $content .= "<a href=\"$URL?token=$token\">$URL?token=$token</a> <br/>";
  $content .= "ถ้านี้เป็นความผิดพลาด ก็ไม่ต้องสนใจอีเมลนี้และจะไม่มีอะไรเกิดขึ้น<br/>";
  $content .= "อีเมลฉบับนี้ส่งจากระบบอัตโนมัติ กรุณาอย่าตอบกลับ";
  $mail->msgHTML($content);

  if($mail->send()){
    // echo 'Message has been sent';
    $user_fullname = $conn->real_escape_string($_POST['user_fullname']);
    $user_email = $conn->real_escape_string($_POST['user_email']);
    $sql = "INSERT INTO user(user_fullname, user_email, token) VALUE('$user_fullname', '$user_email', '$token')";
    if($conn->query($sql)){
      echo "<script>
      alert('บันทึกข้อมูลการสมัครสำเร็จ กรุณายืนยันอีเมลเพื่อยืนยันตัวตนอีกครั้ง');
        window.location.href = 'login.php';
      </script>";
    }else{
      echo "<script>
        alert('บันทึกข้อมูลการสมัครไม่สำเร็จ กรุณาลองใหม่อีกครั้ง');
        window.history.back();
      </script>";
    }
  }
} catch (Exception $e) {
  echo "<script>
    alert('อาจมีอีเมลนี้ในระบบแล้ว หรือเกิดข้อผิดพลาดบางอย่าง กรุณาลองใหม่อีกครั้ง');
    // window.history.back();
  </script>";
}