<?php 
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = date('h');
        $currentAMorPM = date('a');
        $currentTime = intval($currentTime);

        if(($currentTime == 05) && ($currentAMorPM == "pm")){
            udpateRateAlretMember(date('Y-m-d'));
        }
    
    /*
    * @developer : Abhijit Kumar Das
    * @Creation Date: 24th Aug 2023
    * @description : Function for disbale all member who are getting sms.
    */        
    function udpateRateAlretMember($date){
        include_once('dbConfig.php');
        $sql = "SELECT id, user_id FROM rate_alert where rate_alert_date = '".$date."' and status = '1'" ;
        $result = $db->query($sql);

        while($row = $result->fetch_assoc()) {    
            $sql = "UPDATE rate_alert SET `status` = '0'  WHERE `id` = '".$row['id']."' and `user_id` = '".$row['user_id']."'";
            $db->query($sql);
        }
    }
    
    
?>