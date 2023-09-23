<?php 


$your_email = 'no-reply@ibrlive.com';

$error = "";
$success = "";
$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }     

  $errors = [];
  $data = [];
  
$visitor_email = $_POST['email_id'];

     
    $fourdigitrandom = rand(1000,9999); 
    $email_otp = $fourdigitrandom;
    echo($visitor_email);

   
    
    // add otp to db
    $query=mysqli_query($conn,"SELECT * FROM emailvalidate WHERE email='$visitor_email'");
    $num=mysqli_fetch_array($query);
    echo $num;
    if($num>0)
    {   
        mysqli_query($conn,"update emailvalidate set otp='$email_otp' WHERE email='$visitor_email' ");
    }
    else
    {
        $insert = $conn->query("INSERT into  emailvalidate (otp,email)  VALUES ('".$email_otp."','".$visitor_email."') ");
      
    }
    
	//send the email
	$to = $visitor_email;
	$from = $your_email;
	$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
	$body = "<html><body><table><tr style='background: #eee;'><td><strong> OTP (One Time Password) to validate email. (Valid till midnight) </strong></td>\n".
		
        "<tr>
            <td><strong>Subject:</strong> 'OTP for validation account'</td>
        </tr>\n".

		"<tr>
			<td><strong>Email OTP:</strong> ". "$email_otp</td>
		</tr>
			</table></body></html>\n\n";
			$headers = array("From: $from",
				"Reply-To: $your_email",
					"MIME-Version: 1.0",
					"Content-type:text/html;charset=UTF-8",
					"X-Mailer: PHP/" . PHP_VERSION
				);
		$headers = implode("\r\n", $headers);
		
		if(mail($to, 'IBRLive Login OTP', $body,$headers)){  
		   echo "OTP Sent to your email. The email could take 4-5 minutes to deliver.";
		}
		else{
		  echo "Error sending message. Try again later!";
		}
?>