<?php 
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = date('h');
        $currentAMorPM = date('a');
        $currentTime = intval($currentTime);

        if(($currentTime == 9 || $currentTime == 10 || $currentTime == 11) && ($currentAMorPM == "am")){
            sendSms(date('Y-m-d'));
        }
        if(($currentTime == 12 || $currentTime == 01 || $currentTime == 02 || $currentTime == 03 || $currentTime == 04) && ($currentAMorPM == "pm")){
            sendSms(date('Y-m-d'));
        }


    /*
    * @developer : Abhijit Kumar Das
    * @Creation Date: 24th Aug 2023
    * @description : Function for send a sms rate alert able for today.
    */ 
    function sendSms($rateAlertDate){
        include_once('dbConfig.php');
        $sql = "SELECT id, user_id, currency, operator, target_rate, mobile, user_name, user_email FROM rate_alert where rate_alert_date = '".$rateAlertDate."' and status = '1'" ;
        $result = $db->query($sql);

        while($row = $result->fetch_assoc()) {    
            // Initiate curl session in a variable (resource)
            $curl_handle = curl_init();
            $url = "https://currencydatafeed.com/api/data.php?currency=".$row['currency']."/INR&token=6zjjohdl41grpddyxv4k";
            // echo "<br>";
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
            $curl_data = curl_exec($curl_handle);
            curl_close($curl_handle);
            $response_data = json_decode($curl_data);

            $response_api_values = $response_data->currency['0']->value;            

            // if($response_data->status){               
                if($row['operator'] == "1"){
                    // echo "first condition ==> ".$row['id']. '<br>';
                    // if(10.00 > $row['target_rate']){
                    if($response_api_values > $row['target_rate']){
                        // echo "target balance >>>>>> ". $row['target_rate'].'<br><br><br>';
                        // echo "Set balance >>>>>> ". 10.00.'<br><br><br>';
                        $sql = "UPDATE rate_alert SET `status` = '0'  WHERE `id` = '".$row['id']."' and `user_id` = '".$row['user_id']."'";
                        $db->query($sql);

                        whatsAppIntergration($userId = $row['user_id'], $user_mobile = $row['mobile'], $user_name = $row['user_name'], $user_email = $row['user_email'], $user_price = $row['target_rate']);
                    }
                }
                if($row['operator'] == "2"){
                    // echo "second condition =====> ".$row['id']. '<br>';
                    // echo "Set balance >>>>>> ". 20.00.'<br><br><br>';
                    // if(20.00 < $row['target_rate']){
                    if($response_api_values < $row['target_rate']){
                        // echo "target balance >>>>>> ". $row['target_rate'].'<br><br><br>';
                        $sql = "UPDATE rate_alert SET `status` = '0'  WHERE `id` = '".$row['id']."' and `user_id` = '".$row['user_id']."'";
                        $db->query($sql);
                        whatsAppIntergration($userId = $row['user_id'], $user_mobile = $row['mobile'], $user_name = $row['user_name'], $user_email = $row['user_email'], $user_price = $row['target_rate']);
                    }
                        
                }
            // }
        }
    }

    /*
    * @developer : Abhijit Kumar Das
    * @Creation Date: 04th September 2023
    * @description : Function whats app intregration and user update on interakt.
    */ 
    function whatsAppIntergration($userId, $user_mobile, $user_name, $user_email, $user_price){
        // User data update
        $user_id = $userId;
        $mobile = $user_mobile;
        $name = $user_name;
        $email = $user_email;
        $price = $user_price;        
        
        // Header Authorization Data Set 
        $headers = array(
            "Authorization: Basic SkR6dkNjN1R1akVjRTFsaXdhNlMtR1NYQTJNSDE0c3kwQUc0SWl2MzFIODo=",
            "Content-Type: application/json"
        );
        // All API Path
        $interakt_message_url = "https://api.interakt.ai/v1/public/message/";
        $interakt_user_url = "https://api.interakt.ai/v1/public/track/users/";

        // Sms send API details
        $message_data_sets = array(
            "countryCode" => "+91",
            "phoneNumber" => $mobile,
            "callbackData" => "some text here",
            "type" => "Template",
            "template" => array (
                                "name" => "customer_rate_alert",
                                "languageCode" => "en_US"
                                ) 
        );
        $message_post_data = json_encode($message_data_sets);     
 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $interakt_message_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $message_post_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, true);
        $results_message = curl_exec ($curl);
        curl_close ($curl);
       
        // User Data Update
        $user_data = array(
                        "userId" => $user_id,
                        "phoneNumber" => $mobile,
                        "countryCode" => "+91",
                        "traits" => array (
                                            "name" => $name,
                                            "email" => $email,
                                            "device_type_used" => "ipad",
                                            "price" => $price
                                            ) 
                    );
        $user_post_data = json_encode($user_data);       
        $curl_load = curl_init();
        curl_setopt($curl_load, CURLOPT_URL, $interakt_user_url);
        curl_setopt($curl_load, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_load, CURLOPT_POST, true);
        curl_setopt($curl_load, CURLOPT_POSTFIELDS, $user_post_data);
        curl_setopt($curl_load, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_load, CURLOPT_HEADER, true);
        $results_users = curl_exec ($curl_load);
        curl_close ($curl_load);  
    }    
    
?>