<?php 
// ini_set('display_errors', 1); 
// error_reporting(E_ALL);
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

function sendSmsOtp($userphone, $otp) {
  //Initialize cURL.
//$ch = curl_init();
  $message = "Dear User,
  Your OTP for registration to IBRLive portal is $otp . Please do not share this OTP with anyone. IBRLIV";
  $postParameter = array(
    'username' => 'IBRLIVEIND',
    'password' => 'IBRLIVEIND',
    'drout'    => 3,
    'senderid'  => 'IBRLIV',
    'intity_id'  => 1201160750049721812,
    'template_id'  => 1207167575509144057,
    'numbers' => $userphone,
    'language'  => 'en',
    'message'  => $message
);

$ch = curl_init();

$url = "http://dlt.fastsmsindia.com/messages/sendSmsApi";
$dataArray = ['page' => 2];

$data = http_build_query($postParameter);

$getUrl = $url."?".$data;

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $getUrl);
curl_setopt($ch, CURLOPT_TIMEOUT, 80);
   
$response = curl_exec($ch);
//print_r($response);
curl_close($ch);
}

if(isset($_POST['email_id'])){

    $emailuser = $_POST['email_id'];
    $connection = OpenCon();

    $sql = "SELECT phone FROM customers WHERE email='$emailuser'";
    $result = mysqli_query($connection, $sql);
    $row = $result->fetch_assoc();
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
            $bodyContent .= "<div style='padding-top:8px;'>Thank you for registering with us. OTP for for Account Verification is $otp</div><div></div></body></html>"; 
            $mail->Body  = $bodyContent; 
    
            // Send email
            sendSmsOtp($row['phone'], $otp); 
            if(!$mail->send()) { 
              echo 0; 
              exit;
            } else { 
                $sql="UPDATE customers SET email_otp='$otp' WHERE email='$emailuser' ";
                $connection->query($sql);
                echo 1;
              exit;
            }

}
?>