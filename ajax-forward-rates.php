<?php 
    include_once('dbConfig.php');

    $currencyData = $_POST['currency'];
    $rateTypeData = $_POST['rate_type'];
    $operatorData = $_POST['operator'];
    $targetRateData = $_POST['target_rate'];
    $mobileData = $_POST['mobile'];
    $statusData = "1";

        if (session_id() == '' || !isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['userid'])) {
            $userId = $_SESSION['userid'];
            $userName = $_SESSION['username'];
            $userEmail = $_SESSION['useremail'];
        }
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date('Y-m-d H:i:s');
        
        $currentTime = date('h');
        $currentAMorPM = date('a');
        $currentTime = intval($currentTime);        
        if($currentTime >= 5 && $currentTime <= 11 && $currentAMorPM == "pm"){
            $currentDate = date('Y-m-d', strtotime('+1 day'));
        }else {
            $currentDate = date('Y-m-d');
        }        
        
    $sql = "SELECT `id`, `status` FROM rate_alert where user_id = '".$userId."'";
    $result = $db->query($sql);
    $rowss = $result->fetch_row();

    if ($rowss[0]) {
        // if($rowss[1] == '0'){
            $sql = "UPDATE rate_alert SET `currency` ='".$currencyData."', `rate_type` = '".$rateTypeData."', `operator` = '".$operatorData."', `target_rate` = '".$targetRateData."', `mobile` = '".$mobileData."', `status` = '1', `updated_date` = '".$currentDateTime."', `rate_alert_date` = '".$currentDate."'  WHERE id = '".$rowss[0]."'";
            if ($db->query($sql) === TRUE) {
                $result = 200;
            } else {
                $result = 404;
            }            
        // }else{
        //     $result = 400;
        // }
        echo $result;
    }else {
        $sql = "INSERT INTO `rate_alert` (`user_id`, `user_name`, `user_email`, `currency`, `rate_type`, `operator`, `target_rate`, `mobile`, `created_date`, `rate_alert_date`) VALUES ('".$userId."', '".$userName."', '".$userEmail."', '".$currencyData."', '".$rateTypeData."', '".$operatorData."', '".$targetRateData."', '".$mobileData."', '".$currentDateTime."', '".$currentDate."')"; 
            if ($db->query($sql) === TRUE) {
                $result = 200;
            } else {
                $result = 404;
            }
            echo $result;
    }
    die;    
?>