<?php session_start();
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
//Load Composer's autoloader
require 'vendor/autoload.php';

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


$fname=$_POST['fname']; 
$category=$_POST['category']; 
$mobile=$_POST['mobile']; 
$email=$_POST['email']; 
$captcha_val=$_POST['captcha_val'];
$error= array();
if(strlen($fname)<2){
            $error[] = 'Please enter Full Name using 3 charaters atleast.';
        }
 if(strlen($fname)>2){
            if(!preg_match("/^[a-zA-Z\s]+$/", $fname)){
            $error[] = 'Full Name:Characters Only (No digits or special charaters) ';
        } 
        }
          if(strlen($fname)>20){
            $error[] = 'Full Name: Max length 20 Characters Not allowed';
        }
          
           
         if($email ==''){
            $error[] = 'Please enter email';
        
        }

        if(strlen($email)!=''){
            if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
            $error[] = 'Enter Valid email id';
        } 
        }
         if(strlen($mobile)!=10){
            $error[] = 'Mobile: Please enter 10 digits mobile number without country code';
        }
        if(strlen($category)==''){
            $error[] = 'Please select service category';
        }
    if($captcha_val ==''){
            $error[] = 'Please enter captcha';
        
        }
        if($captcha_val!='')
        {
              if ($_SESSION['captcha'] != $captcha_val)
        {
         $error[]='Invalid captcha'; 

         }

        }

         $erro=array(); 
         $i='<i class="fa fa-warning"></i>';
        foreach($error as $err)
        {
        $erro[]=$i.' '.$err;  
        }
        $error_str=implode('<br>', $erro); 
            if($error!=NULL)
            {
                $last_status='failed'; 
            }
        if($error==NULL){
            
        // $FromName='IBRLive';
        // $FromEmail='no-reply@ibrlive.com';
        // $to_email='contact@ibrlive.com';
        // $credits="All rights are reserved | ".$FromName; 
        // $headers  = "MIME-Version: 1.0\n";
        // $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        // $headers .= "From: ".$FromName." <".$FromEmail.">\n";
        // //$headers .= "Reply-To: ".$ReplyTo."\n";
        // $headers .= "X-Sender: <".$FromEmail.">\n";
        // $headers .= "X-Mailer: PHP\n"; 
        // $headers .= "X-Priority: 1\n"; 
        // $headers .= "Return-Path: <".$FromEmail.">\n"; 
        // $subject="You have received a contact message from  ".$FromName; 
        // $msg=$message='Name:- '.$fname.'<br>Email:- ' .$email.'<br> Mobile Number:- '.$mobile.'<br> Service interested in:- '.$category;
        // if(mail($to_email, $subject, $headers,'-f'.$FromEmail) ){

        //     $last_status='Thank you for showing interest in our services. We have received your inquiry and we will get back to you soon.';
        // } 
        // else {
        //     $last_status="failed";
        //     $error_str="Server failed to send email , Please try again ...";
        // } 

        // Sender info 
        $mail->setFrom('no-reply@ibrlive.com', 'IBRLive'); 

        // Add a recipient 
        $mail->addAddress('contact@ibrlive.com'); 
        
        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 
        
        // Set email format to HTML 
        $mail->isHTML(true); 
        
        // Mail subject 
        $mail->Subject = 'You have received a enquiry from : '.$fname; 

        // Mail body content 
        $bodyContent = "<html></body><div><div>Hello Team,</div></br></br>"; 
        $bodyContent .= "<div style='padding-top:8px;'>Name:- $fname <br>Email:- $email<br> Mobile Number:- $mobile<br> Service interested in:- $category <br><br><br>Thank You.</div><div></div></body></html>"; 
        $mail->Body  = $bodyContent; 

        // Send email
        //sendSmsOtp($phone, $otp); 
        if(!$mail->send()) { 
            $last_status="failed";
            $error_str="Server failed to send email , Please try again ...";
        } else { 
            $last_status="success";
            //$last_status='Thank you for showing interest in our services. We have received your inquiry and we will get back to you soon.';
            // $sql="insert into otpdata (email, phone, otp) values('$emailuser', '$phone', $otp)";
            // $connection->query($sql);
            // echo 1;
            // exit;
        }
    }
$response = array(
    'errors' =>  $error_str,
    'status' => $last_status
);
echo json_encode($response);

?> 