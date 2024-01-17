<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
include_once('lib/database.php');

// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer;
// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Host = 'mail.ibrlive.com';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'no-reply@ibrlive.com';       // SMTP username 
$mail->Password = 'Bruno@0346';         // SMTP password 
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 465;

//Generating 6 Digit Random OTP
$otp = mt_rand(100000, 999999);

function sendSmsOtp($userphone, $otp)
{
  //Initialize cURL.
  //$ch = curl_init();
  $message = "Thank you for choosing IBRLive! Your One-Time Password (OTP) for account registration is:".$otp.". Please enter this OTP on the registration page to verify your account. Learn and spread";
 
 $postParameter = array(
    'username' => 'IBRLIVEIND',
    'password' => 'IBRLIVEIND',
    'drout'    => 3,
    'senderid'  => 'IBRLVE',
    'intity_id'  => 1201160750049721812,
    'template_id'  => 1207169477708083511,
    'numbers' => $userphone,
    'language'  => 'en',
    'message'  => $message
  );

  $ch = curl_init();

  $url = "http://dlt.fastsmsindia.com/messages/sendSmsApi";
  $dataArray = ['page' => 2];

  $data = http_build_query($postParameter);

  $getUrl = $url . "?" . $data;

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_URL, $getUrl);
  curl_setopt($ch, CURLOPT_TIMEOUT, 80);

  $response = curl_exec($ch);
  curl_close($ch);
}

if (isset($_POST['email_id'])) {

  $emailuser = $_POST['email_id'];
  $phone = $_POST['phone'];
  $connection = OpenCon();
  // Sender info 
  $mail->setFrom('no-reply@ibrlive.com', 'IBRLive');

  // Add a recipient 
  $mail->addAddress($emailuser);

  //$mail->addCC('cc@example.com'); 
  //$mail->addBCC('bcc@example.com'); 

  // Set email format to HTML 
  $mail->isHTML(true);

  // Mail subject 
  $mail->Subject = 'Email OTP Verification : IBRLive';

  // Mail body content 
  $bodyContent = "<html></body><div><div>Dear User,</div></br></br>";
  $bodyContent .= "<div style='padding-top:8px;'>Thank you for registering with us. OTP for Account Verification is $otp</div><div></div></body></html>";
  $mail->Body  = $bodyContent;

  // Send email
  sendSmsOtp($phone, $otp);
  if (!$mail->send()) {
    echo 0;
    exit;
  } else {
    $sql = "insert into otpdata (email, phone, otp) values('$emailuser', '$phone', $otp)";
    $connection->query($sql);
    echo 1;
    // $sql="UPDATE customers SET email_otp='$otp' WHERE email='$emailuser' ";
    // $connection->query($sql);
    // echo 1;
    exit;
  }
}
