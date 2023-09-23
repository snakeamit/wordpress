<?php
  if(isset($_POST['sendFeedback'])){
    $uid = $_SESSION['userid'];
    $utopic = $_POST['utopic'];
    $uquery = $_POST['uquery'];
    $your_email = 'no-reply@ibrlive.com';
    $visitor_email = '';

    $visitor_email = $_SESSION['useremail'];
    if($visitor_email == ""){
      $errorFeed="Your are not authorized to send feedback.";
    }

    if($errorFeed == ""){
      $to = "contact@ibrlive.com";
      $from = $your_email;
      $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

      $body = "<html><body><table><tr style='background: #eee;'><td><strong> Feedback from IBRLive User: </strong></td>\n".
    "<tr>
       <td><strong>User ID:</strong> ". "$uid</td>
       <td><strong>User Email:</strong> ". "$visitor_email</td>
     </tr>\n".
    "<tr>
       <td><strong>Topic:</strong> ". "$utopic</td>
       <td><strong>User IP:</strong> ". "$ip</td>
     </tr>\n".
    "<tr>
       <td><strong>Message:</strong> ". "$uquery</td>
     </tr>
     </table></body></html>\n\n";
    $headers = array("From: $from",
      "Reply-To: $your_email",
      "MIME-Version: 1.0",
      "Content-type:text/html;charset=UTF-8",
      "X-Mailer: PHP/" . PHP_VERSION
      );

      $headers = array("From: $from",
        "Reply-To: $your_email",
        "MIME-Version: 1.0",
        "Content-type:text/html;charset=UTF-8",
        "X-Mailer: PHP/" . PHP_VERSION
      );
      $headers = implode("\r\n", $headers);
      if(mail($to, 'IBRLive user feedback', $body, $headers)){
        $successFeed="Thanks for the feedback!";
      }else{
        $errorFeed="Try again later!";
      }  
    }	    
  }
?>
