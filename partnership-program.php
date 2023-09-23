<!DOCTYPE html>
<?php if(isset($_POST['submit'])){

    $msg = '';
    $visitor_name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $visitor_phone = $_POST['number'];
    $visitor_business = $_POST['business'];

    $servername = "localhost";
    $username = "ibrlive";
    $password = "tubelight";
    $dbname = "ibrMock";
    
    //Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if(!$conn){  
        die('Could not connect: '.mysqli_connect_error());
    }

    $sql = "INSERT INTO reach_out (visitor_name, email, contact, business)VALUES ('$visitor_name', '$visitor_email', '$visitor_phone', '$visitor_business')";
    //echo $sql; die();
    if (mysqli_query($conn, $sql)) {
        
        //echo "hello1111";die;
        $msg = "Your data submitted successfully. We'll reach you shortly.";
        ////send the email
        //$email_to = $visitor_email;
        $to = "contact@ibrlive.com";
        //$to = "rakeshkumar@sleekinfo.com";
        //echo $to; die;
        //$from = $visitor_email;
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        $body = "<html><body><table><tr style='background: #eee;'><td><strong>$visitor_name</strong> wants you to contact him/her.</td>\n" .
        "<tr><td><strong>Name:</strong> $visitor_name</td></tr>\n" .
        "<tr><td><strong>Phone:</strong> " . " $visitor_phone</td></tr>\n" .
        "<tr><td><strong>User Email:</strong> " .
        "$visitor_email</td>
                    <td><strong>Visitor Business:</strong> " .
        "$visitor_business</td></tr></table></body></html>\n\n"; //.
        "IP: $ip\n";
        $replyfrom = 'no-reply@ibrlive.com';

        $headers = array(
        "From: $replyfrom",
        // "Reply-To: $visitor_email",
        "MIME-Version: 1.0",
        "Content-type:text/html;charset=UTF-8",
        "X-Mailer: PHP/" . PHP_VERSION
        );
        $headers = implode("\r\n", $headers);

        if (mail($to, 'IELTS Partner Program', $body, $headers)) {
           // $toadmin = "papiya@sleekinfo.com";
        //echo $to; die;
        //$from = $visitor_email;
            $email_to = $visitor_email;
            $ipset = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        
             $bodyadmin="<html><body><table><tr style='background: #eee;'>

             We appreciate your interest in working with us.
              
             <br>
             We have received your request and will get in touch with you soon.
             </tr>
             </table>
             </body>
             </html>";


            // $body = "<html><body><table><tr style='background: #eee;'><td><strong>$visitor_name</strong> wants you to contact him/her.</td>\n" .
            // "<tr><td><strong>Name:</strong> $visitor_name</td></tr>\n" .
            // "<tr><td><strong>Phone:</strong> " . " $visitor_phone</td></tr>\n" .
            // "<tr><td><strong>User Email:</strong> " .
            // "$visitor_email</td>
            //             <td><strong>Visitor Business:</strong> " .
            // "$visitor_business</td></tr></table></body></html>\n\n"; //.
            // "IP: $ip\n";
            $replyfrom= 'no-reply@ibrlive.com';

            $headersadmin = array(
            "From: $replyfrom",
            // "Reply-To: $visitor_email",
            "MIME-Version: 1.0",
            "Content-type:text/html;charset=UTF-8",
            "X-Mailer: PHP/" . PHP_VERSION
            );
            $headersadmin = implode("\r\n", $headersadmin);
            //mail($email_to, 'reach out form',  $bodyadmin,$headersadmin );
                if(mail($email_to, 'reach out form',  $bodyadmin,$headersadmin )){
                    echo '<script>
                        alert("Your data submitted successfully, We will reach you shortly");
                    </script>';
        
                }

                
            }
         else {
           

            echo "Something went wrong. Please try again later.";
        }
    
 

    } else {

        $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // if (empty($errors)) {
        //send the email
        // $to = "contact@ibrlive.com";
        // $from = $visitor_email;
        // $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        // $body = "<html><body><table><tr style='background: #eee;'><td><strong>$visitor_name</strong> wants you to contact him/her.</td>\n" .
        // "<tr><td><strong>Name:</strong> $visitor_name</td></tr>\n" .
        // "<tr><td><strong>Phone:</strong> " . " $visitor_phone</td></tr>\n" .
        // "<tr><td><strong>User Email:</strong> " .
        // "$visitor_email</td>
        //             <td><strong>Visitor Business:</strong> " .
        // "$visitor_business</td></tr></table></body></html>\n\n"; //.
        // "IP: $ip\n";
        // $headers = array(
        // "From: $from",
        // // "Reply-To: $visitor_email",
        // "MIME-Version: 1.0",
        // "Content-type:text/html;charset=UTF-8",
        // "X-Mailer: PHP/" . PHP_VERSION
        // );
        // $headers = implode("\r\n", $headers);

        // if (mail($to, 'reach out form', $body, $headers)) {
            
        // } else {
        //     echo "Something went wrong. Please try again later.";
        // }
    // }
} ?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
    <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

    <title>Partnership-Program</title>
     


    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="bower_components/jquery-ui/jquery-ui.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
    <!-- <link rel="stylesheet" href="js/dist/assets/owl.carousel.css">
  <link rel="stylesheet" href="js/dist/assets/owl.theme.default.min.css"> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <!-- <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/noborder.css">
    <link rel="stylesheet" href="css/converter.css">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <link rel="manifest" href="/images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">

    <meta name="theme-color" content="#ffffff">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="calculations.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/daterangepicker/daterangepicker.css" />

    <script>
        var fs = "2023-06-16";
        var bidArray = {
            "17-07-2023": "7.48",
            "17-08-2023": "16.93",
            "15-09-2023": "25.65",
            "16-10-2023": "35.84",
            "15-11-2023": "46",
            "15-12-2023": "56.17",
            "15-01-2024": "67.69",
            "15-02-2024": "80.2",
            "15-03-2024": "91.68",
            "15-04-2024": "109.21",
            "15-05-2024": "127.25",
            "17-06-2024": "144.1"
        };
        var askArray = {
            "17-07-2023": "9.48",
            "17-08-2023": "18.93",
            "15-09-2023": "27.65",
            "16-10-2023": "37.84",
            "15-11-2023": "48",
            "15-12-2023": "58.17",
            "15-01-2024": "69.69",
            "15-02-2024": "82.2",
            "15-03-2024": "93.68",
            "15-04-2024": "111.21",
            "15-05-2024": "129.25",
            "17-06-2024": "146.1"
        };
        var tomspotflag = 1;

        function CalSpotFwdBidSample(sourceForm) {
            var bid;
            var re = new RegExp('<' + 'font' + '[^><]*>|<.' + 'font' + '[^><]*>', 'g')
            var bodyText;
            n = document.getElementById("pairSelExp").value;

            if (n == 1 || n == 2 || n == 3) {

            } else {
                document.getElementById('fwdExp').value = "Not Available";
                document.getElementById('fwdPremBid').value = "Not Available";
                alert("Soon Available!");
                return;
            }

            var bidArray;

            if (n == 1) {
                bodyText = document.getElementById("inrToUSDbid").innerHTML;
                bidArray = {
                    "17-07-2023": "7.48",
                    "17-08-2023": "16.93",
                    "15-09-2023": "25.65",
                    "16-10-2023": "35.84",
                    "15-11-2023": "46",
                    "15-12-2023": "56.17",
                    "15-01-2024": "67.69",
                    "15-02-2024": "80.2",
                    "15-03-2024": "91.68",
                    "15-04-2024": "109.21",
                    "15-05-2024": "127.25",
                    "17-06-2024": "144.1"
                };
            } else if (n == 2) {
                bodyText = document.getElementById("inrToEURbid").innerHTML;
                bidArray = {
                    "17-07-2023": "24",
                    "17-08-2023": "49",
                    "15-09-2023": "73",
                    "16-10-2023": "100",
                    "15-11-2023": "123",
                    "15-12-2023": "149",
                    "15-01-2024": "180",
                    "15-02-2024": "205",
                    "15-03-2024": "231",
                    "15-04-2024": "263",
                    "15-05-2024": "293",
                    "17-06-2024": "320"
                };
            } else if (n == 3) {
                bodyText = document.getElementById("inrToGBPbid").innerHTML;
                bidArray = {
                    "17-07-2023": "15",
                    "17-08-2023": "33",
                    "15-09-2023": "47",
                    "16-10-2023": "64",
                    "15-11-2023": "78",
                    "15-12-2023": "88",
                    "15-01-2024": "106",
                    "15-02-2024": "119",
                    "15-03-2024": "129",
                    "15-04-2024": "149",
                    "15-05-2024": "161",
                    "17-06-2024": "180"
                };
            } else {
                return;
            }

            bodyText = bodyText.replace(re, '');
            bid = parseFloat(bodyText);

            var ds = sourceForm.dateExp.value;
            if (ds == "") {
                return;
            }

            ds = ds.toString().split('-');
            ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
            ds_.setHours(0, 0, 0, 0);

            var fs = "2023-06-16";
            var fs_ = new Date(fs); //Forward Start Date
            fs_.setHours(0, 0, 0, 0);

            var dprev_ = fs_; // date prev month = forward start date (Initially)
            var dnext_; // this will be set in for loop (see next)
            var pprev_ = 0; // forward premium = 0 (Initially)
            var pnext_ = 0; // this will be set in for loop (see next)
            var fwdprem = 0;
            var spotFwdRate = 0;
            var flag = 0; // got the final spot fwd rate

            for (var key in bidArray) {
                var value = bidArray[key];
                sd = key.toString().split('-');
                sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
                sd_.setHours(0, 0, 0, 0);

                dnext_ = sd_; // bidArray key is settlement date = date next
                ddiff_ = parseInt((ds_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;
                pnext_ = parseFloat(value);
                dp_ = parseFloat(pnext_ - pprev_); // difference premium
                dmdiff_ = parseInt((dnext_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;


                if (ds_ >= dprev_ && ds_ <= dnext_) {
                    fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                    spotFwdRate = parseFloat(parseFloat(bid) + fwdprem / 100).toFixed(4);

                    flag = 1;
                    break;
                }

                dprev_ = dnext_;
                pprev_ = pnext_;
            }

            if (flag == 1) {
                document.getElementById('fwdExp').value = parseFloat(spotFwdRate).toFixed(4);
                document.getElementById('fwdPremBid').value = parseFloat(fwdprem / 100).toFixed(4);
            } else {
                document.getElementById('fwdExp').value = "Not Available";
                document.getElementById('fwdPremBid').value = "Not Available";
            }
        }

        function CalSpotFwdAskSample(sourceForm) {
            var ask;
            var re = new RegExp('<' + 'font' + '[^><]*>|<.' + 'font' + '[^><]*>', 'g')
            var bodyText;

            n = document.getElementById("pairSelImp").value;
            if (n == 1 || n == 2 || n == 3) {

            } else {
                document.getElementById('fwdImp').value = "";
                document.getElementById('fwdPremAsk').value = "";
                //alert("Soon Available!");
                return;
            }

            var ds = sourceForm.dateImp.value;
            if (ds == "") {
                return;
            }
            ds = ds.toString().split('-');
            ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
            ds_.setHours(0, 0, 0, 0);

            var askArray = {
                "17-07-2023": "9.48",
                "17-08-2023": "18.93",
                "15-09-2023": "27.65",
                "16-10-2023": "37.84",
                "15-11-2023": "48",
                "15-12-2023": "58.17",
                "15-01-2024": "69.69",
                "15-02-2024": "82.2",
                "15-03-2024": "93.68",
                "15-04-2024": "111.21",
                "15-05-2024": "129.25",
                "17-06-2024": "146.1"
            };

            if (n == 1) {
                bodyText = document.getElementById("inrToUSDask").innerHTML;
                askArray = {
                    "17-07-2023": "9.48",
                    "17-08-2023": "18.93",
                    "15-09-2023": "27.65",
                    "16-10-2023": "37.84",
                    "15-11-2023": "48",
                    "15-12-2023": "58.17",
                    "15-01-2024": "69.69",
                    "15-02-2024": "82.2",
                    "15-03-2024": "93.68",
                    "15-04-2024": "111.21",
                    "15-05-2024": "129.25",
                    "17-06-2024": "146.1"
                };
            } else if (n == 2) {
                bodyText = document.getElementById("inrToEURask").innerHTML;
                askArray = {
                    "17-07-2023": "26",
                    "17-08-2023": "52",
                    "15-09-2023": "75",
                    "16-10-2023": "103",
                    "15-11-2023": "126",
                    "15-12-2023": "152",
                    "15-01-2024": "184",
                    "15-02-2024": "209",
                    "15-03-2024": "234",
                    "15-04-2024": "266",
                    "15-05-2024": "296",
                    "17-06-2024": "324"
                };
            } else if (n == 3) {
                bodyText = document.getElementById("inrToGBPask").innerHTML;
                askArray = {
                    "17-07-2023": "18",
                    "17-08-2023": "36",
                    "15-09-2023": "51",
                    "16-10-2023": "68",
                    "15-11-2023": "81",
                    "15-12-2023": "92",
                    "15-01-2024": "110",
                    "15-02-2024": "123",
                    "15-03-2024": "133",
                    "15-04-2024": "153",
                    "15-05-2024": "165",
                    "17-06-2024": "184"
                };
            } else {
                return;
            }

            bodyText = bodyText.replace(re, '');
            ask = parseFloat(bodyText);

            var fs = "2023-06-16";
            var fs_ = new Date(fs); //Forward Start Date
            fs_.setHours(0, 0, 0, 0);

            var dprev_ = fs_; // date prev month = forward start date (Initially)
            var dnext_; // this will be set in for loop (see next)
            var pprev_ = 0; // forward premium = 0 (Initially)
            var pnext_ = 0; // this will be set in for loop (see next)
            var fwdprem = 0;
            var spotFwdRate = 0;
            var flag = 0; // got the final spot fwd rate

            for (var key in askArray) {
                var value = askArray[key];
                sd = key.toString().split('-');
                sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
                sd_.setHours(0, 0, 0, 0);

                dnext_ = sd_; // askArray key is settlement date = date next
                ddiff_ = parseInt((ds_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;
                pnext_ = parseFloat(value);
                dp_ = parseFloat(pnext_ - pprev_); // difference premium
                dmdiff_ = parseInt((dnext_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;

                if (ds_ >= dprev_ && ds_ <= dnext_) {
                    fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                    spotFwdRate = parseFloat(parseFloat(ask) + fwdprem / 100).toFixed(4);

                    flag = 1;
                    break;
                }

                dprev_ = dnext_;
                pprev_ = pnext_;
            }

            if (flag == 1) {
                document.getElementById('fwdImp').value = parseFloat(spotFwdRate).toFixed(4);
                document.getElementById('fwdPremAsk').value = parseFloat(fwdprem / 100).toFixed(4);
            } else {
                document.getElementById('fwdImp').value = "Not Available";
                document.getElementById('fwdPremAsk').value = "Not Available";
            }
        }

        function CalSpotFwdBid(sourceForm) {
            var bid;
            var re = new RegExp('<' + 'font' + '[^><]*>|<.' + 'font' + '[^><]*>', 'g')
            var bodyText;
            n = document.getElementById("pairSelExp").value;
            if (n == 1) {

            } else {
                document.getElementById('fwdExp').value = "Not Available";
                document.getElementById('fwdPremBid').value = "Not Available";
                //alert("Soon Available!");
                return;
            }
            bodyText = document.getElementById("inrToUSDbid").innerHTML;
            bodyText = bodyText.replace(re, '');
            bid = parseFloat(bodyText);

            var ds = sourceForm.dateExp.value;
            if (ds == "") {
                document.getElementById('fwdExp').value = "Not Available";
                document.getElementById('fwdPremBid').value = "Not Available";
                //alert("Soon Available!");
                return;
            }

            ds = ds.toString().split('-');
            ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
            ds_.setHours(0, 0, 0, 0);

            var bidArray = {
                "17-07-2023": "7.48",
                "17-08-2023": "16.93",
                "15-09-2023": "25.65",
                "16-10-2023": "35.84",
                "15-11-2023": "46",
                "15-12-2023": "56.17",
                "15-01-2024": "67.69",
                "15-02-2024": "80.2",
                "15-03-2024": "91.68",
                "15-04-2024": "109.21",
                "15-05-2024": "127.25",
                "17-06-2024": "144.1"
            };

            var fs = "2023-06-16";
            var fs_ = new Date(fs); //Forward Start Date
            fs_.setHours(0, 0, 0, 0);

            var dprev_ = fs_; // date prev month = forward start date (Initially)
            var dnext_; // this will be set in for loop (see next)
            var pprev_ = 0; // forward premium = 0 (Initially)
            var pnext_ = 0; // this will be set in for loop (see next)
            var fwdprem = 0;
            var spotFwdRate = 0;
            var flag = 0; // got the final spot fwd rate

            for (var key in bidArray) {
                var value = bidArray[key];
                sd = key.toString().split('-');
                sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
                sd_.setHours(0, 0, 0, 0);

                dnext_ = sd_; // bidArray key is settlement date = date next
                ddiff_ = parseInt((ds_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;
                pnext_ = parseFloat(value);
                dp_ = parseFloat(pnext_ - pprev_); // difference premium
                dmdiff_ = parseInt((dnext_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;


                if (ds_ >= dprev_ && ds_ <= dnext_) {
                    fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                    spotFwdRate = parseFloat(parseFloat(bid) + fwdprem / 100).toFixed(4);

                    flag = 1;
                    break;
                }

                dprev_ = dnext_;
                pprev_ = pnext_;
            }

            if (flag == 1) {
                document.getElementById('fwdExp').value = parseFloat(spotFwdRate).toFixed(4);
                document.getElementById('fwdPremBid').value = parseFloat(fwdprem / 100).toFixed(4);
            } else {
                document.getElementById('fwdExp').value = "Not Available";
                document.getElementById('fwdPremBid').value = "Not Available";
            }
        }

        function CalSpotFwdAsk(sourceForm) {
            var ask;
            var re = new RegExp('<' + 'font' + '[^><]*>|<.' + 'font' + '[^><]*>', 'g')
            var bodyText;
            bodyText = document.getElementById("inrToUSDask").innerHTML;
            bodyText = bodyText.replace(re, '');
            ask = parseFloat(bodyText);
            n = document.getElementById("pairSelImp").value;
            if (n == 1) {

            } else {
                document.getElementById('fwdImp').value = "Not Available";
                document.getElementById('fwdPremAsk').value = "Not Available";
                //alert("Soon Available!");
                return;
            }

            var ds = sourceForm.dateImp.value;
            if (ds == "") {
                document.getElementById('fwdImp').value = "Not Available";
                document.getElementById('fwdPremAsk').value = "Not Available";
                //alert("Soon Available!");
                return;
            }
            ds = ds.toString().split('-');
            ds_ = new Date(ds[2], ds[1] - 1, ds[0]);
            ds_.setHours(0, 0, 0, 0);

            var askArray = {
                "17-07-2023": "9.48",
                "17-08-2023": "18.93",
                "15-09-2023": "27.65",
                "16-10-2023": "37.84",
                "15-11-2023": "48",
                "15-12-2023": "58.17",
                "15-01-2024": "69.69",
                "15-02-2024": "82.2",
                "15-03-2024": "93.68",
                "15-04-2024": "111.21",
                "15-05-2024": "129.25",
                "17-06-2024": "146.1"
            };

            var fs = "2023-06-16";
            var fs_ = new Date(fs); //Forward Start Date
            fs_.setHours(0, 0, 0, 0);

            var dprev_ = fs_; // date prev month = forward start date (Initially)
            var dnext_; // this will be set in for loop (see next)
            var pprev_ = 0; // forward premium = 0 (Initially)
            var pnext_ = 0; // this will be set in for loop (see next)
            var fwdprem = 0;
            var spotFwdRate = 0;
            var flag = 0; // got the final spot fwd rate

            for (var key in askArray) {
                var value = askArray[key];
                sd = key.toString().split('-');
                sd_ = new Date(sd[2], sd[1] - 1, sd[0]); // settlement date
                sd_.setHours(0, 0, 0, 0);

                dnext_ = sd_; // askArray key is settlement date = date next
                ddiff_ = parseInt((ds_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;
                pnext_ = parseFloat(value);
                dp_ = parseFloat(pnext_ - pprev_); // difference premium
                dmdiff_ = parseInt((dnext_ - dprev_) / (1000 * 60 * 60 * 24)) + 1;

                if (ds_ >= dprev_ && ds_ <= dnext_) {
                    fwdprem = pprev_ + (dp_ * (ddiff_ / dmdiff_));

                    spotFwdRate = parseFloat(parseFloat(ask) + fwdprem / 100).toFixed(4);

                    flag = 1;
                    break;
                }

                dprev_ = dnext_;
                pprev_ = pnext_;
            }

            if (flag == 1) {
                document.getElementById('fwdImp').value = parseFloat(spotFwdRate).toFixed(4);
                document.getElementById('fwdPremAsk').value = parseFloat(fwdprem / 100).toFixed(4);
            } else {
                document.getElementById('fwdImp').value = "Not Available";
                document.getElementById('fwdPremAsk').value = "Not Available";
            }
        }
    </script>

    <script>
        //var urlNews="https://newsapi.org/v2/top-headlines?country=in&pageSize=15&category=business&apiKey=ae6228a1b731425fb97446ca3424d2bf",req=new Request(urlNews);

        function findHistData() {
            var e = document.getElementById("startTimestamp").value,
                t = document.getElementById("endTimestamp").value,
                n = document.getElementById("pairSel").value;
            $("#hist-data td").remove(), $("#coverScreen").show(), $.post("get-hist-data", {
                data: "1",
                pair: n,
                t1: e,
                t2: t
            }, function(e) {
                var t = e.split("#"),
                    n = document.getElementById("hist-data"),
                    d = t[0],
                    a = 0;
                if ($("#hist-data td").remove(), $("#hist-data").show(), d > 0)
                    for (var i = 0; i < d; i++) {
                        var r;
                        tr = document.createElement("tr"), (r = document.createElement("td")).style.fontSize = "16px", r.className = "numeric";
                        var l = document.createElement("td");
                        l.style.fontSize = "16px", l.className = "numeric";
                        var c = document.createElement("td");
                        c.style.fontSize = "16px", c.className = "numeric";
                        var m = document.createElement("td");
                        m.style.fontSize = "16px", m.className = "numeric";
                        var b = document.createElement("td");
                        b.style.fontSize = "16px", b.className = "numeric";
                        t[a = 5 * i + 1].split(" ");
                        var o = new Date(t[a].replace(/-/g, "/"));
                        r.appendChild(document.createTextNode(o.toLocaleDateString("en-US", {
                            weekday: "long",
                            year: "numeric",
                            month: "long",
                            day: "numeric"
                        }))), l.appendChild(document.createTextNode(t[a + 1])), c.appendChild(document.createTextNode(t[a + 2])), m.appendChild(document.createTextNode(t[a + 3])), b.appendChild(document.createTextNode(t[a + 4])), tr.appendChild(r), tr.appendChild(l), tr.appendChild(c), tr.appendChild(m), tr.appendChild(b), n.appendChild(tr)
                    } else tr = document.createElement("tr"), (r = document.createElement("td")).style.fontSize = "16px", r.colSpan = "5", r.appendChild(document.createTextNode("No Data Available")), tr.appendChild(r), n.appendChild(tr);
                $("#coverScreen").hide()
            })
        }

        //fetch(req).then(function(e){return e.json()}).then(function(e){document.getElementById("newsFeed1").innerHTML=e.articles[0].title,document.getElementById("newsFeed2").innerHTML=e.articles[1].title,document.getElementById("newsFeed3").innerHTML=e.articles[2].title,document.getElementById("newsFeed4").innerHTML=e.articles[3].title,document.getElementById("newsFeed5").innerHTML=e.articles[4].title,document.getElementById("newsFeed6").innerHTML=e.articles[5].title,document.getElementById("newsFeed7").innerHTML=e.articles[6].title,document.getElementById("newsFeed8").innerHTML=e.articles[7].title,document.getElementById("newsFeed9").innerHTML=e.articles[8].title,document.getElementById("newsFeed10").innerHTML=e.articles[9].title});
    </script>

    <script>
        var prevVal = 0,
            prevValEUR = 0,
            prevValGBP = 0,
            prevValAUD = 0,
            prevValCAD = 0,
            prevValNZD = 0,
            prevValAED = 0,
            prevValSGD = 0,
            prevValTHB = 0,
            prevValCNY = 0,
            newVal = 0,
            newValEUR = 0,
            newValGBP = 0,
            newValAUD = 0,
            newValCAD = 0,
            newValNZD = 0,
            newValAED = 0,
            newValSGD = 0,
            newValTHB = 0,
            newValCNY = 0,


            eurTousdc = 0
        gbpTousdc = 0,
            audTousdc = 0,
            nzdTousdc = 0,
            eurTogbpc = 0,
            usdTojpyc = 0,
            usdTocnyc = 0,
            usdTochfc = 0,
            usdTocadc = 0,
            usdTohkdc = 0,

            eurTousdd = 0
        gbpTousdd = 0,
            audTousdd = 0,
            nzdTousdd = 0,
            eurTogbpd = 0,
            usdTojpyd = 0,
            usdTocnyd = 0,
            usdTochfd = 0,
            usdTocadd = 0,
            usdTohkdd = 0,


            rcvData = function() {

                "1" != sessionStorage.getItem("infodone") && sessionStorage.setItem("infodone", "1");
                setInterval(function() {
                    0;
                }, 1e3);
                $("#coverScreen").hide(),
                    $.post("get-live-rates", {
                        data: "1"
                    }, function(e) {
                        //findTomSpotBidData("1");
                        //findTomSpotAskData("1");
                        //alert(document.getElementById("pairSelTomAsk").value);
                        //alert(document.getElementById("pairSelTomBid").value);
                        var val1 = document.getElementById("pairSelTomAsk").value;
                        var val2 = document.getElementById("pairSelTomBid").value;
                        switch (val1) {
                            case "1":
                                findTomSpotAskData("1");
                                break;
                            case "2":
                                findTomSpotAskData("2");
                                break;
                            case "3":
                                findTomSpotAskData("3");
                                break;
                        }

                        switch (val2) {
                            case "1":
                                findTomSpotBidData("1");
                                break;
                            case "2":
                                findTomSpotBidData("2");
                                break;
                            case "3":
                                findTomSpotBidData("3");
                                break;
                        }

                        var t = e.split("-");
                        if (((usdToINRrate = 0), "0" == t[1])) document.getElementById("inrToUSD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            var o = parseFloat(t[2]).toFixed(4),
                                n = parseFloat(t[3]).toFixed(4),
                                a = 0;
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (usdToINRrate = a),
                            (document.getElementById("inrToUSDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToUSDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToUSD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            (document.getElementById("frate-1").value = parseFloat(a).toFixed(4)),
                            0 == prevVal ?
                                ((newVal = parseFloat(a).toFixed(4)), (prevVal = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevVal ?
                                ((newVal = parseFloat(a).toFixed(4)), (prevVal = parseFloat(a).toFixed(4))) :
                                ((newVal = parseFloat(a).toFixed(4)), (prevVal = newVal), (document.getElementById("inrToUSD").style.backgroundColor = "#F2D7D5")),
                                (document.getElementById("inrToUSDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[4]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToUSDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[5]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[11]) document.getElementById("inrToEUR").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(t[12]).toFixed(4)), (n = parseFloat(t[13]).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToEURbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToEURask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToEUR").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            (document.getElementById("frate-2").value = parseFloat(a).toFixed(4)),
                            0 == prevValEUR ?
                                ((newValEUR = parseFloat(a).toFixed(4)), (prevValEUR = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValEUR ?
                                ((newValEUR = parseFloat(a).toFixed(4)), (prevValEUR = parseFloat(a).toFixed(4))) :
                                ((newValEUR = parseFloat(a).toFixed(4)), (prevValEUR = newValEUR), (document.getElementById("inrToEUR").style.backgroundColor = "#EBDEF0")),
                                (document.getElementById("inrToEURhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[14]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToEURlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[15]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[21]) document.getElementById("inrToGBP").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(t[22]).toFixed(4)), (n = parseFloat(t[23]).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToGBPbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToGBPask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToGBP").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            (document.getElementById("frate-3").value = parseFloat(a).toFixed(4)),
                            0 == prevValGBP ?
                                ((newValGBP = parseFloat(a).toFixed(4)), (prevValGBP = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValGBP ?
                                ((newValGBP = parseFloat(a).toFixed(4)), (prevValGBP = parseFloat(a).toFixed(4))) :
                                ((newValGBP = parseFloat(a).toFixed(4)), (prevValGBP = newValGBP), (document.getElementById("inrToGBP").style.backgroundColor = "#D4E6F1")),
                                (document.getElementById("inrToGBPhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[24]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToGBPlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[25]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[31]) document.getElementById("inrToAUD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(t[32]).toFixed(4)), (n = parseFloat(t[33]).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToAUDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToAUDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToAUD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValAUD ?
                                ((newValAUD = parseFloat(a).toFixed(4)), (prevValAUD = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValAUD ?
                                ((newValAUD = parseFloat(a).toFixed(4)), (prevValAUD = parseFloat(a).toFixed(4))) :
                                ((newValAUD = parseFloat(a).toFixed(4)), (prevValAUD = newValAUD), (document.getElementById("inrToAUD").style.backgroundColor = "#D1F2EB")),
                                (document.getElementById("inrToAUDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[34]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToAUDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[35]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[41]) document.getElementById("inrToCAD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(parseFloat(t[42]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[43]).toFixed(4)).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToCADbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToCADask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToCAD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValCAD ?
                                ((newValCAD = parseFloat(a).toFixed(4)), (prevValCAD = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValCAD ?
                                ((newValCAD = parseFloat(a).toFixed(4)), (prevValCAD = parseFloat(a).toFixed(4))) :
                                ((newValCAD = parseFloat(a).toFixed(4)), (prevValCAD = newValCAD), (document.getElementById("inrToCAD").style.backgroundColor = "#D4EFDF")),
                                (document.getElementById("inrToCADhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[44]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToCADlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[45]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[51]) document.getElementById("inrToNZD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(t[52]).toFixed(4)), (n = parseFloat(t[53]).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToNZDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToNZDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToNZD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValNZD ?
                                ((newValNZD = parseFloat(a).toFixed(4)), (prevValNZD = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValNZD ?
                                ((newValNZD = parseFloat(a).toFixed(4)), (prevValNZD = parseFloat(a).toFixed(4))) :
                                ((newValNZD = parseFloat(a).toFixed(4)), (prevValNZD = newValNZD), (document.getElementById("inrToNZD").style.backgroundColor = "#FCF3CF")),
                                (document.getElementById("inrToNZDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[54]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToNZDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[55]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[61]) document.getElementById("inrToTHB").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(parseFloat(t[62]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[63]).toFixed(4)).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToTHBbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToTHBask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToTHB").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValTHB ?
                                ((newValTHB = parseFloat(a).toFixed(4)), (prevValTHB = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValTHB ?
                                ((newValTHB = parseFloat(a).toFixed(4)), (prevValTHB = parseFloat(a).toFixed(4))) :
                                ((newValTHB = parseFloat(a).toFixed(4)), (prevValTHB = newValTHB), (document.getElementById("inrToTHB").style.backgroundColor = "#FAE5D3")),
                                (document.getElementById("inrToTHBhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[64]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToTHBlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[65]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[71]) document.getElementById("inrToAED").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(parseFloat(t[72]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[73]).toFixed(4)).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToAEDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToAEDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToAED").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValAED ?
                                ((newValAED = parseFloat(a).toFixed(4)), (prevValAED = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValAED ?
                                ((newValAED = parseFloat(a).toFixed(4)), (prevValAED = parseFloat(a).toFixed(4))) :
                                ((newValAED = parseFloat(a).toFixed(4)), (prevValAED = newValAED), (document.getElementById("inrToAED").style.backgroundColor = "#FAE5D3")),
                                (document.getElementById("inrToAEDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[74]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToAEDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[75]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[81]) document.getElementById("inrToSGD").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(parseFloat(t[82]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[83]).toFixed(4)).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToSGDbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToSGDask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToSGD").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValSGD ?
                                ((newValSGD = parseFloat(a).toFixed(4)), (prevValSGD = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValSGD ?
                                ((newValSGD = parseFloat(a).toFixed(4)), (prevValSGD = parseFloat(a).toFixed(4))) :
                                ((newValSGD = parseFloat(a).toFixed(4)), (prevValSGD = newValSGD), (document.getElementById("inrToSGD").style.backgroundColor = "#FAE5D3")),
                                (document.getElementById("inrToSGDhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[84]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToSGDlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[85]).toFixed(4) + "</font>");
                        }
                        if ("0" == t[91]) document.getElementById("inrToCNY").innerHTML = '<font style="font-size: 16px; color: #164f75;">Available Soon</font>';
                        else {
                            (o = parseFloat(parseFloat(t[92]).toFixed(4)).toFixed(4)), (n = parseFloat(parseFloat(t[93]).toFixed(4)).toFixed(4)), (a = 0);
                            (a = (parseFloat(o) + parseFloat(n)) / parseFloat(2)),
                            (document.getElementById("inrToCNYbid").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(o).toFixed(4) + "</font>"),
                            (document.getElementById("inrToCNYask").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(n).toFixed(4) + "</font>"),
                            (document.getElementById("inrToCNY").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(a).toFixed(4) + "</font>"),
                            0 == prevValCNY ?
                                ((newValCNY = parseFloat(a).toFixed(4)), (prevValCNY = parseFloat(a).toFixed(4))) :
                                parseFloat(a).toFixed(4) == prevValCNY ?
                                ((newValCNY = parseFloat(a).toFixed(4)), (prevValCNY = parseFloat(a).toFixed(4))) :
                                ((newValCNY = parseFloat(a).toFixed(4)), (prevValCNY = newValCNY), (document.getElementById("inrToCNY").style.backgroundColor = "#FAE5D3")),
                                (document.getElementById("inrToCNYhigh").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[94]).toFixed(4) + "</font>"),
                                (document.getElementById("inrToCNYlow").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + parseFloat(t[95]).toFixed(4) + "</font>");
                        }
                        setTimeout(function() {
                            (document.getElementById("inrToUSD").style.backgroundColor = "#f9f9f9"),
                            (document.getElementById("inrToEUR").style.backgroundColor = "white"),
                            (document.getElementById("inrToGBP").style.backgroundColor = "#f9f9f9"),
                            (document.getElementById("inrToAUD").style.backgroundColor = "white"),
                            (document.getElementById("inrToCAD").style.backgroundColor = "#f9f9f9"),
                            (document.getElementById("inrToNZD").style.backgroundColor = "white"),
                            (document.getElementById("inrToAED").style.backgroundColor = "#f9f9f9"),
                            (document.getElementById("inrToTHB").style.backgroundColor = "#f9f9f9"),
                            (document.getElementById("inrToSGD").style.backgroundColor = "white"),
                            (document.getElementById("inrToCNY").style.backgroundColor = "white"),
                            document.getElementById("eurANDusd").style.backgroundColor = "white",
                                (document.getElementById("gbpANDusd").style.backgroundColor = "white"),
                                (document.getElementById("audANDusd").style.backgroundColor = "white"),
                                (document.getElementById("nzdANDusd").style.backgroundColor = "white"),
                                (document.getElementById("eurANDgbp").style.backgroundColor = "white"),
                                (document.getElementById("usdANDjpy").style.backgroundColor = "white"),
                                (document.getElementById("usdANDcny").style.backgroundColor = "white"),
                                (document.getElementById("usdANDchf").style.backgroundColor = "white"),
                                (document.getElementById("usdANDcad").style.backgroundColor = "white"),
                                (document.getElementById("usdANDhkd").style.backgroundColor = "white");
                        }, 1e4);
                    }),

                    $.post("get-extra-live-rates", {
                        data: "1"
                    }, function(e) {


                        var t = e.split("-");

                        var eurTousd = parseFloat((parseFloat(t[2]) + parseFloat(t[3])) / 2).toFixed(4);
                        var gbpTousd = parseFloat((parseFloat(t[12]) + parseFloat(t[13])) / 2).toFixed(4);
                        var audTousd = parseFloat((parseFloat(t[22]) + parseFloat(t[23])) / 2).toFixed(4);
                        var nzdTousd = parseFloat((parseFloat(t[32]) + parseFloat(t[33])) / 2).toFixed(4);
                        var eurTogbp = parseFloat((parseFloat(t[42]) + parseFloat(t[43])) / 2).toFixed(4);
                        var usdTojpy = parseFloat((parseFloat(t[52]) + parseFloat(t[53])) / 2).toFixed(4);
                        var usdTocny = parseFloat((parseFloat(t[62]) + parseFloat(t[63])) / 2).toFixed(4);
                        var usdTochf = parseFloat((parseFloat(t[72]) + parseFloat(t[73])) / 2).toFixed(4);
                        var usdTocad = parseFloat((parseFloat(t[82]) + parseFloat(t[83])) / 2).toFixed(4);
                        var usdTohkd = parseFloat((parseFloat(t[92]) + parseFloat(t[93])) / 2).toFixed(4);




                        document.getElementById("eurANDusd").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + eurTousd + "</font>";
                        0 == eurTousdc ?
                            ((eurTousdd = parseFloat(eurTousd)), (eurTousdc = parseFloat(eurTousd))) :
                            parseFloat(eurTousd) == eurTousdc ?
                            ((eurTousdd = parseFloat(eurTousd)), (eurTousdc = parseFloat(eurTousd))) :
                            ((eurTousdd = parseFloat(eurTousd)), (eurTousdc = eurTousdd), (document.getElementById("eurANDusd").style.backgroundColor = "#D4EFDF"));




                        document.getElementById("gbpANDusd").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + gbpTousd + "</font>";
                        0 == eurTousdc ?
                            ((gbpTousdd = parseFloat(gbpTousd)), (gbpTousdc = parseFloat(gbpTousd))) :
                            parseFloat(gbpTousd) == gbpTousdc ?
                            ((gbpTousdd = parseFloat(gbpTousd)), (gbpTousdc = parseFloat(gbpTousd))) :
                            ((gbpTousdd = parseFloat(gbpTousd)), (gbpTousdc = gbpTousdd), (document.getElementById("gbpANDusd").style.backgroundColor = "#D1F2EB"));






                        document.getElementById("audANDusd").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + audTousd + "</font>";
                        0 == audTousdc ?
                            ((audTousdd = parseFloat(audTousd)), (audTousdc = parseFloat(audTousd))) :
                            parseFloat(audTousd) == audTousdc ?
                            ((audTousdd = parseFloat(audTousd)), (audTousdc = parseFloat(audTousd))) :
                            ((audTousdd = parseFloat(audTousd)), (audTousdc = audTousdd), (document.getElementById("audANDusd").style.backgroundColor = "#FCF3CF"));


                        document.getElementById("nzdANDusd").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + nzdTousd + "</font>";
                        0 == nzdTousdc ?
                            ((nzdTousdd = parseFloat(nzdTousd)), (nzdTousdc = parseFloat(nzdTousd))) :
                            parseFloat(nzdTousd) == nzdTousdc ?
                            ((nzdTousdd = parseFloat(nzdTousd)), (nzdTousdc = parseFloat(nzdTousd))) :
                            ((nzdTousdd = parseFloat(nzdTousd)), (nzdTousdc = nzdTousdd), (document.getElementById("nzdANDusd").style.backgroundColor = "#FCF3CF"));



                        document.getElementById("eurANDgbp").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + eurTogbp + "</font>";
                        0 == eurTogbpc ?
                            ((eurTogbpd = parseFloat(eurTogbp)), (eurTogbpc = parseFloat(eurTogbp))) :
                            parseFloat(eurTogbp) == eurTogbpc ?
                            ((eurTogbpd = parseFloat(eurTogbp)), (eurTogbpc = parseFloat(eurTogbp))) :
                            ((eurTogbpd = parseFloat(eurTogbp)), (eurTogbpc = eurTogbpd), (document.getElementById("eurANDgbp").style.backgroundColor = "#FCF3CF"));


                        document.getElementById("usdANDjpy").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + usdTojpy + "</font>";
                        0 == usdTojpyc ?
                            ((usdTojpyd = parseFloat(usdTojpy)), (usdTojpyc = parseFloat(usdTojpy))) :
                            parseFloat(usdTojpy) == usdTojpyc ?
                            ((usdTojpyd = parseFloat(usdTojpy)), (usdTojpyc = parseFloat(usdTojpy))) :
                            ((usdTojpyd = parseFloat(usdTojpy)), (usdTojpyc = usdTojpyd), (document.getElementById("usdANDjpy").style.backgroundColor = "#D4EFDF"));


                        document.getElementById("usdANDcny").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + usdTocny + "</font>";
                        0 == usdTocnyc ?
                            ((usdTocnyd = parseFloat(usdTocny)), (usdTocnyc = parseFloat(usdTocny))) :
                            parseFloat(usdTocny) == usdTocnyc ?
                            ((usdTocnyd = parseFloat(usdTocny)), (usdTocnyc = parseFloat(usdTocny))) :
                            ((usdTocnyd = parseFloat(usdTocny)), (usdTocnyc = usdTocnyd), (document.getElementById("usdANDcny").style.backgroundColor = "#FCF3CF"));




                        document.getElementById("usdANDchf").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + usdTochf + "</font>";
                        0 == usdTochfc ?
                            ((usdTochfd = parseFloat(usdTochf)), (usdTochfc = parseFloat(usdTochf))) :
                            parseFloat(usdTochf) == usdTochfc ?
                            ((usdTochfd = parseFloat(usdTochf)), (usdTochfc = parseFloat(usdTochf))) :
                            ((usdTochfd = parseFloat(usdTochf)), (usdTochfc = usdTochfd), (document.getElementById("usdANDchf").style.backgroundColor = "#FCF3CF")),




                            document.getElementById("usdANDcad").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + usdTocad + "</font>"
                        0 == usdTocadc ?
                            ((usdTocadd = parseFloat(usdTocad)), (usdTocadc = parseFloat(usdTocad))) :
                            parseFloat(usdTocad) == usdTocadc ?
                            ((usdTocadd = parseFloat(usdTocad)), (usdTocadc = parseFloat(usdTocad))) :
                            ((usdTocadd = parseFloat(usdTocad)), (usdTocadc = usdTocadd), (document.getElementById("usdANDcad").style.backgroundColor = "#FCF3CF")),

                            0 == usdTohkdc ?
                            ((usdTohkdd = parseFloat(usdTohkd)), (usdTohkdc = parseFloat(usdTohkd))) :
                            parseFloat(usdTohkd) == usdTohkdc ?
                            ((usdTohkdd = parseFloat(usdTohkd)), (usdTohkdc = parseFloat(usdTohkd))) :
                            ((usdTohkdd = parseFloat(usdTohkd)), (usdTohkdc = usdTohkdd), (document.getElementById("usdANDhkd").style.backgroundColor = "#D4EFDF")),


                            document.getElementById("usdANDhkd").innerHTML = '<font style="font-size: 20px; color: #164f75;">' + usdTohkd + "</font>"












                    }),



                    $("#coverScreen").hide();

            };

        setInterval(function() {
            rcvData();
        }, 1e3);
        var f1 = 0;

        function CalculateGST(e, t, o) {
            var n,
                a = e.unit_input.value,
                l = t.unit_input.value,
                r = 0;
            isNaN(a) && (a = a.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (a = a.replace(/\.+$/, "")),
                isNaN(l) && (l = l.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (l = l.replace(/\.+$/, "")),
                (n = parseFloat(a) * parseFloat(l)),
                a <= 0 || l <= 0 ? (r = 0) : n <= 1e5 ? (n <= 250 ? (r = 45) : (r = 0.01 * n * 0.18) <= 45 && (r = 45)) : (r = n > 1e5 && n <= 1e6 ? 0.18 * (1e3 + 0.005 * (n - 1e5)) : n < 555e5 ? 0.18 * (5500 + 0.001 * (n - 1e6)) : 10800),
                (e.unit_input.value = a),
                (t.unit_input.value = l),
                (o.unit_input.value = r.toFixed(2));
        }

        function CalculateUnit(e, t) {
            var o = e.unit_input.value;
            isNaN(o) && (o = o.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (o = o.replace(/\.+$/, ""));
            var n = 0;
            switch (t.unit_menu.value) {
                case "INR":
                    n = o;
                    break;
                case "USD":
                    n = 1 / parseFloat(document.getElementById("inrToUSD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "EUR":
                    n = 1 / parseFloat(document.getElementById("inrToEUR").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "GBP":
                    n = 1 / parseFloat(document.getElementById("inrToGBP").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "AUD":
                    n = 1 / parseFloat(document.getElementById("inrToAUD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "CAD":
                    n = 1 / parseFloat(document.getElementById("inrToCAD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "NZD":
                    n = 1 / parseFloat(document.getElementById("inrToNZD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "THB":
                    n = 1 / parseFloat(document.getElementById("inrToTHB").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "SGD":
                    n = 1 / parseFloat(document.getElementById("inrToSGD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "AED":
                    n = 1 / parseFloat(document.getElementById("inrToAED").getElementsByTagName("font")[0].innerHTML);
                case "CNY":
                    n = 1 / parseFloat(document.getElementById("inrToCNY").getElementsByTagName("font")[0].innerHTML);
                    break;
            }
            isNaN(o) && 0 != o ? (t.unit_input.value = "") : ((e.unit_input.value = o), "INR" == t.unit_menu.value ? (t.unit_input.value = o) : (t.unit_input.value = (o * n).toFixed(2)));
        }

        function CalculateUnit2(e, t) {
            var o = e.unit2_input.value;
            isNaN(o) && (o = o.replace(/[^0-9\.]/g, "")).split(".").length > 2 && (o = o.replace(/\.+$/, ""));
            var n = 0;
            switch (e.unit2_menu.value) {
                case "INR":
                    n = o;
                    break;
                case "USD":
                    n = parseFloat(document.getElementById("inrToUSD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "EUR":
                    n = parseFloat(document.getElementById("inrToEUR").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "GBP":
                    n = parseFloat(document.getElementById("inrToGBP").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "AUD":
                    n = parseFloat(document.getElementById("inrToAUD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "CAD":
                    n = parseFloat(document.getElementById("inrToCAD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "NZD":
                    n = parseFloat(document.getElementById("inrToNZD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "THB":
                    n = parseFloat(document.getElementById("inrToTHB").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "SGD":
                    n = parseFloat(document.getElementById("inrToSGD").getElementsByTagName("font")[0].innerHTML);
                    break;
                case "AED":
                    n = parseFloat(document.getElementById("inrToAED").getElementsByTagName("font")[0].innerHTML);
                case "CNY":
                    n = parseFloat(document.getElementById("inrToCNY").getElementsByTagName("font")[0].innerHTML);
                    break;
            }
            isNaN(o) && 0 != o ? (t.unit2_input.value = "") : ((e.unit2_input.value = o), "INR" == e.unit2_menu.value ? (t.unit2_input.value = o) : (t.unit2_input.value = (o * n).toFixed(2)));
        }
    </script>



    <!--Start of Tawk.to Script-->
    <!--script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5fc481da920fc91564cbdf67/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script-->
    <!--End of Tawk.to Script-->

    <!-- <meta name="google-site-verification" content="BJ7SrXsVSkkq6qIuc_hFQGACiOBm5QVhm--yW_F7tG0" /> -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123754068-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-123754068-1');
    </script>


    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] = c[a] || function() {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "dcrqpo0b2s");


        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>


</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body onload="rcvData();">

    <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-bottom: 0px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
        <div>
            We have updated our website. Please delete your cookies to experience the new design. Use ctrl+shift+r to hard referesh.
        </div>
    </div>

    <!-- <div id="coverScreen" class="LockOnHome"></div> -->

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
        <div class="spinner"></div>
    </div>
    <div class="container-fluid position-relative p-0 head-nav">
        <script>
            function showMF() {
                document.getElementById("mfopt").style.display = "block", document.getElementById("feopt").style.display = "none"
            }

            function showFE() {
                document.getElementById("feopt").style.display = "block", document.getElementById("mfopt").style.display = "none"
            }

            function hideMFFE() {
                document.getElementById("feopt").style.display = "none", document.getElementById("mfopt").style.display = "none"
            }
        </script>
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .blink_me {
                animation: blinker 1s linear infinite;
            }

            @keyframes blinker {
                50% {
                    opacity: 0;
                }
            }
        </style>

        <div class="nav-cont">
            <nav class="navbar navbar-expand-lg navbar-dark py-3 py-lg-0">

                <div class="container">

                    <a href="/home" class="navbar-brand p-0 mt-3">
                        <h1 class="m-0"><img src="img/logo.png" alt="IBrlive Pvt Ltd" class="logo"></h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
                            <a href="/home" class="nav-item nav-link active">Home</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                                <div class="dropdown-menu m-0">
                                    <a href="/usd-inr-forecast" class="dropdown-item">Forecast</a>
                                    <a href="/forward-rates" class="dropdown-item">Forward rate</a>
                                    <a href="/central-bank-interest-rates" class="dropdown-item">Benchmark rate</a>
                                    <a href="/plans-and-pricing" class="dropdown-item">Rate alert</a>
                                </div>
                            </div>
                            <a href="/lei-code" class="nav-item nav-link">Get LEI</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Resources</a>
                                <div class="dropdown-menu m-0">
                                <a href="/blogs" class="dropdown-item">Blogs</a>
                                <a href="https://ibrlive.estudium.org/products/Paid-NISM-Series%20V-A-Mutual%20Funds-English" target="_blank" class="dropdown-item">Mutual Funds</a>
                                <a href="https://ibrlive.estudium.org/products/Paid-IIBF-FE-Foreign%20Exchange-English" target="_blank" class="dropdown-item">Foreign Exchange</a>
                                <a href="/rbi-master-directions" class="dropdown-item">RBI Master Directions</a>
                                </div>
                            </div>
                            <a href="/plans-and-pricing" class="nav-item nav-link">Plan and Pricing</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Company</a>
                                <div class="dropdown-menu m-0">
                                <a href="/about" class="dropdown-item">About</a>
                                <a href="/contact" class="dropdown-item">Contact Us</a>
                                <a href="/partnership-program" class="dropdown-item">Partnership Program</a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown px-4 ms-3">
                            <button class="btn btn-secondary dropdown-toggle my-drop" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user"></i>
            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/register">New User</a></li>
                                <li><a class="dropdown-item" href="/ibrlive/login">Existing User</a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </nav>
        </div>
      <div class="partnership-ban" style="background-image:url(./images/partern-program/prg-ban-2.png)">
          <div class="container">
            <div class="row align-items-center g-0 flex-row-reverse">
                <div class="col-md-5">
                    <div class="partnership-ban-img text-center">
                      <img class="w-100" src="images/partern-program/prg-ban-img.png" alt="">
                    </div>
                </div>
              <div class="col-md-7">
                <div class="partnership-ban-sloan">
                  <h1>A Superlative<br><span>Approach</span> to<br>Collaborate</h1>
                  <p>Partner with us for a seamless and profitable collaboration
                      in the overseas education industry. </p>
                    <a class="partner-btn-cmn" href="#partnership-opn-frm">Get Started <span><img src="images/partern-program/partnt-btn-arw.png" alt=""></span></a>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="partnership-ban-bottom">
          <div class="container">
            <div class="text-center">
              <h2>Why Choose IBRLIVE India Private Limited?</h2>
              <p>We specialize in sending education fees abroad, opening GIC accounts for students, and providing a range of reliable
                services. As a private limited company dedicated to facilitating student visa services, we are committed to assisting IELTS
                centers and agents in maximizing their earnings while ensuring the success of their students.</p>
            </div>
                <div class="each-part-prg-cont">
                  <div class="row">
                    <div class="col-lg-4 col-md-6">
                      <div class="each-part-prg-box">
                        <img src="images/partern-program/rate-prg.png" alt="">
                        <h3>High Commission Rates </h3>
                        <p>We believe in the value of partnerships and strive to provide the most
                          competitive commission rates in the industry. With IBRLIVE, you can earn more than 95% commission for every student referral, making it a lucrative opportunity for IELTS centers and agents.</p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="each-part-prg-box">
                        <img src="images/partern-program/businessman.png" alt="">
                        <h3>GIC Account Opening Bonus</h3>
                        <p>We value and reward our partners for their trust and support. When you refer a student to us for opening a GIC account through IBRLIVE, you'll receive a generous incentive of 50 Canadian dollars. It's our way of expressing gratitude for your
                          continued partnership.</p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="each-part-prg-box">
                        <img src="images/partern-program/agreement.png" alt="">
                        <h3>Strong Partnerships</h3>
                        <p>IBRLIVE India Private Limited has established collaborations with renowned international education and finance entities. Our partnerships with Flywire, Convera, and CIBC ensure smooth and secure transactions when sending education fees abroad. We take pride in the reliability and efficiency of our services, allowing you to offer the best solutions to your students.</p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="each-part-prg-box">
                        <img src="images/partern-program/legal.png" alt="">
                        <h3>Compliance and Legality </h3>
                       <p>We strictly adhere to all relevant regulations and guidelines, including those outlined under the Liberalized Remittance Scheme (LRS). Rest assured, we handle all remittances abroad for family maintenance and other approved purposes in a compliant manner, ensuring peace of mind for both you and you students.</p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="each-part-prg-box">
                        <img src="images/partern-program/communicate.png" alt="">
                        <h3>Convenient Contact Information </h3>
                       <p>We understand the importance of easy communication. Reach out to us at any time via our mobile number +91 9991622344 or email us at contact@ibrlive.com. Our responsive team is always available to assist you with your queries and
                        partnership requirements.</p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="each-part-prg-box">
                        <img src="images/partern-program/address.png" alt="">
                        <h3>Trusted Registered Address </h3>
                       <p>IBRLIVE India Private Limited is a registered company with a strong presence in the education services sector. Our registered address is in Kurukshetra, ensuring credibility and accountability
                        in our operations.</p>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="partnership-foot-top" id="partnership-opn-frm" style="background: url(./images/partern-program/prg-cont-bg.png);">
        <div class="container">
          <div class="text-center">
            <p>By partnering with IBRLIVE India Private Limited, you gain access to a reliable and rewarding collaboration in the
              student visa services and overseas education domain. Let's work together to help students achieve their dreams of studying abroad while maximizing your business potential.<br></p>
              <p>
                To explore partnership opportunities, please contact us today at +91 9991622344 or email us at contact@ibrlive.com. We look forward to forging a successful and long-term partnership with you!</p>
          </div>
        </div>
      </div>
      <div class="partnership-contact">
        <div class="container">
          <div class="partnership-contact-wrap" id="reach_out_form">
            <?php //if (!empty($msg)) {
              //echo "<p class='err' style='text-align: center; color:green; font-size: 14px; animation: fadeOut 5s;'>" . nl2br($msg) . "</p>";
            //} ?>
            <form role="form" method="POST" name="reach_out_form" action="" >
            <!-- <form action=""> -->
              <div class="text-center">
                <h2>To reach out to us, fill this form here</h2>
              </div>
              <div class="row">
                <div class="col-md-6 pe-3">
                  <input type="text" name= "name" class="form-control" placeholder="Name*" required>
                </div>
                <div class="col-md-6">
                  <input type="text" maxlength="10" name="number" class="form-control" placeholder="Contact Number*" required>
                </div>
                <div class="col-md-6 pe-3">
                  <input type="email" name="email" class="form-control" placeholder="Email ID*" required>
                </div>
                <div class="col-md-6">
                  <input type="text" name="business" class="form-control" placeholder="Business Name">
                </div>
              </div>
              <div class="box-footer" align=center>
                <button value="Submit" name="submit" type="submit" id="submit" class="btn btn-primary">Submit</button>
              </div>
              <!-- <div class="text-center">
                <a class="partner-btn-cmn" href="#">Submit <span><img src="images/partern-program/partnt-btn-arw.png" alt=""></span></a>
              </div> -->
            </form>
          </div>
        </div>
      </div>
    </div>


  
      <div class="container-fluid pt-4 wow fadeInUp " data-wow-delay="0.1s " style="display:none; ">
      <div class="container ">
        <div class="box-header " align=center>

          <p class="box-title " style="font-size: 22px; "><i class="fa fa-bullseye "></i> <b>FXPRESS by IBRLive <a href="https://ibrlive.com/register ">
                <font style="color: green; ">(Register now to start 10 Days Free Trial!)</font>
              </a></b></p>
        </div>

        <div class="box-body " align=center>

          <div class="col col-lg-4 text-center " style="background: #fff; ">
            <div class="h-100 p-2 rounded-3 position-relative "><iframe style="width:100%; height: 100%; " src="https://www.youtube.com/embed/7YRYQRNNtMg?rel=0 " frameborder="0 " allow="accelerometer; encrypted-media; gyroscope; picture-in-picture " allowfullscreen></iframe></div>
          </div>

          <div class="col col-lg-8 text-center " style="margin-bottom: 10px; ">
            <h4 class="bg-danger " style="padding: 5px; "><i>Exporter or Importer?</i></h4>
            <h4 class="bg-info " style="padding: 5px; "><i>Paying Heavy Exchange Margin on currency conversion?</i></h4>
            <h4 class="bg-success " style="padding: 5px; "><i>
                If Yes, then you are at right place to put hold on your increasing financial cost</i></h4>
            <hr>

            <a href="fxpress "><button type="button " style="margin-top:5px; " class="btn btn-success "><i class="fa fa-info-circle "></i> Click for more information! </button></a>

            <a href="our-products " style="margin-top:5px; "><button type="button " style="margin-top:5px; " class="btn btn-warning "> <i class="fa fa-angle-double-right "></i> Subscribe to FXPRESS Now! </button></a>
          </div>
        </div>
      </div>
    </div>
  
  <div class="modal fade " id="modal-default ">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header ">
          <button type="button " class="close " data-dismiss="modal " aria-label="Close ">
            <span aria-hidden="true ">&times;</span></button>
          <h4 class="modal-title "><b>GST on Currency Conversion</b></h4>
        </div>
        <div class="modal-body ">
          <table class="table table-bordered text-center table-bordered table-striped table-condensed cf ">
            <thead>
              <tr>
                <th>Transaction Amount</th>
                <th>Value on Service</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Less than or equal to &#8377; 1,00,000</td>
                <td>1% of the transaction amount, subject to minimum of &#8377; 250/- ( minimum GST payable = &#8377; 45)</td>
              </tr>
              <tr>
                <td>Greater than &#8377; 1,00,000 and less than or equal to &#8377; 10,00,000</td>
                <td>&#8377; 1000 + 0.5% of the transaction amount</td>
              </tr>
              <tr>
                <td>Greater than &#8377; 10,00,000</td>
                <td>&#8377; 5,500 + 0.1% of the transaction amount, subject to maximum of &#8377; 60,000/-. (Maximum GST payable = &#8377; 10,800/-)</td>
              </tr>
              <tr>
                <td colspan=2><b>* GST: 18% of Value on Service</b></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer ">
          <button type="button " class="btn btn-default pull-left " data-dismiss="modal ">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  

        <div class="container-fluid bg-dark text-light pt-4 footer-se mt-5 wow bg-4 footer " data-wow-delay="0.1s">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-12 col-md-6">
                        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto">
                            <h3 class="text-light mb-4 mt-4">Talk To Us</h3>
                            <h5 class="text-light mb-4" style="font-weight: 300 !important;">Feel free to call, email, or hit us up on our social media accounts</h5>
                            <a href="https://ibrlive.com/contact" class="btn btn-light py-md-3 px-md-5 animated">CONTACT US</a>
                        </div>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-2 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-2">PHONE</h3>
                            <h5 class="text-light" style="font-weight: 300 !important;">+91-9991622344</h5>
                        </div>
                        <p class="f-18"><a href="https://ibrlive.com/privacy-policy" class="text-light">Privacy Policy</a></p>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-2 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-2">EMAIL</h3>
                            <h5 class="text-light" style="font-weight: 300 !important;">contact@ibrlive.com</h5>
                        </div>
                        <p class="f-18"><a href="https://ibrlive.com/terms-and-conditions" class="text-light">Terms and Conditions</a></p>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-2 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-2">FOLLOW US</h3>
                            <h4 style="font-weight: 300 !important;"><a href="https://www.facebook.com/ibrliveindia/" class="text-light"><i class="fab fa-facebook-f"></i></a> &nbsp; <a href="https://twitter.com/ibr_live" class="text-light"><i class="fab fa-twitter"></i></a> &nbsp; <a href="https://www.instagram.com/ibrlive/"
                                    class="text-light"><i class="fab fa-instagram"></i></a> &nbsp; <a href="https://www.linkedin.com/company/ibrlive/" class="text-light"><i class="fab fa-linkedin"></i></a></h4>
                        </div>
                        <p class="f-18"><a href="https://ibrlive.com/refund-cancellation" class="text-light">Refund and Cancellation</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            (function(w, d, s, c, r, a, m) {
                w['KiwiObject'] = r;
                w[r] = w[r] || function() {
                    (w[r].q = w[r].q || []).push(arguments)
                };
                w[r].l = 1 * new Date();
                a = d.createElement(s);
                m = d.getElementsByTagName(s)[0];
                a.async = 1;
                a.src = c;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', "https://app.interakt.ai/kiwi-sdk/kiwi-sdk-17-prod-min.js?v=" + new Date().getTime(), 'kiwi');
            window.addEventListener("load", function() {
                kiwi.init('', 'Zlw2804l9EzYOcZ43XoLkBDSBvuUJjUV', {});
            });
        </script>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- <script src="js/dist/owl.carousel.min.js"></script> -->
    <script>
        //   $('.owl-carousel').owlCarousel({
        //     loop:false,
        //     navigation : true,
        //     outerWidth: 100,
        //     items: 8,
        //     autoplay: true,
        //     autoplayHoverPause: true,
        //     autoplayTimeout: 5000,
        //     responsive:{
        //         0:{
        //             items:1
        //         },
        //         600:{
        //             items:3
        //         },
        //         1000:{
        //             items:5
        //         }
        //     }
        // })
    </script>
    <!-- AdminLTE App -->
    <!-- <script src="dist/js/adminlte.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <script src="bower_components/jquery-ui/jquery-ui.js"></script>
    <script>
        var holidayArr = {
            "17-12-2022": 1,
            "18-12-2022": 1,
            "24-12-2022": 1,
            "25-12-2022": 1,
            "31-12-2022": 1,
            "07-01-2023": 1,
            "08-01-2023": 1,
            "14-01-2023": 1,
            "15-01-2023": 1,
            "21-01-2023": 1,
            "22-01-2023": 1,
            "26-01-2023": 1,
            "28-01-2023": 1,
            "29-01-2023": 1,
            "04-02-2023": 1,
            "05-02-2023": 1,
            "11-02-2023": 1,
            "12-02-2023": 1,
            "18-02-2023": 1,
            "19-02-2023": 1,
            "25-02-2023": 1,
            "26-02-2023": 1,
            "04-03-2023": 1,
            "05-03-2023": 1,
            "08-03-2023": 1,
            "11-03-2023": 1,
            "12-03-2023": 1,
            "18-03-2023": 1,
            "19-03-2023": 1,
            "25-03-2023": 1,
            "26-03-2023": 1,
            "30-03-2023": 1,
            "01-04-2023": 1,
            "02-04-2023": 1,
            "07-04-2023": 1,
            "08-04-2023": 1,
            "09-04-2023": 1,
            "14-04-2023": 1,
            "15-04-2023": 1,
            "16-04-2023": 1,
            "22-04-2023": 1,
            "23-04-2023": 1,
            "29-04-2023": 1,
            "30-04-2023": 1,
            "01-05-2023": 1,
            "05-05-2023": 1,
            "06-05-2023": 1,
            "07-05-2023": 1,
            "13-05-2023": 1,
            "14-05-2023": 1,
            "20-05-2023": 1,
            "21-05-2023": 1,
            "27-05-2023": 1,
            "28-05-2023": 1,
            "03-06-2023": 1,
            "04-06-2023": 1,
            "10-06-2023": 1,
            "11-06-2023": 1,
            "17-06-2023": 1,
            "18-06-2023": 1,
            "24-06-2023": 1,
            "25-06-2023": 1,
            "29-06-2023": 1,
            "01-07-2023": 1,
            "02-07-2023": 1,
            "08-07-2023": 1,
            "09-07-2023": 1,
            "15-07-2023": 1,
            "16-07-2023": 1,
            "22-07-2023": 1,
            "23-07-2023": 1,
            "29-07-2023": 1,
            "30-07-2023": 1,
            "05-08-2023": 1,
            "06-08-2023": 1,
            "12-08-2023": 1,
            "13-08-2023": 1,
            "15-08-2023": 1,
            "16-08-2023": 1,
            "19-08-2023": 1,
            "20-08-2023": 1,
            "26-08-2023": 1,
            "27-08-2023": 1,
            "02-09-2023": 1,
            "03-09-2023": 1,
            "09-09-2023": 1,
            "10-09-2023": 1,
            "16-09-2023": 1,
            "17-09-2023": 1,
            "19-09-2023": 1,
            "23-09-2023": 1,
            "24-09-2023": 1,
            "28-09-2023": 1,
            "30-09-2023": 1,
            "01-10-2023": 1,
            "02-10-2023": 1,
            "07-10-2023": 1,
            "08-10-2023": 1,
            "14-10-2023": 1,
            "15-10-2023": 1,
            "21-10-2023": 1,
            "22-10-2023": 1,
            "24-10-2023": 1,
            "28-10-2023": 1,
            "29-10-2023": 1,
            "04-11-2023": 1,
            "05-11-2023": 1,
            "11-11-2023": 1,
            "12-11-2023": 1,
            "14-11-2023": 1,
            "18-11-2023": 1,
            "19-11-2023": 1,
            "25-11-2023": 1,
            "26-11-2023": 1,
            "27-11-2023": 1,
            "02-12-2023": 1,
            "03-12-2023": 1,
            "09-12-2023": 1,
            "10-12-2023": 1,
            "16-12-2023": 1,
            "17-12-2023": 1,
            "23-12-2023": 1,
            "24-12-2023": 1,
            "25-12-2023": 1,
            "30-12-2023": 1,
            "31-12-2023": 1,
            "06-01-2024": 1,
            "07-01-2024": 1,
            "13-01-2024": 1,
            "14-01-2024": 1,
            "20-01-2024": 1,
            "21-01-2024": 1,
            "27-01-2024": 1,
            "28-01-2024": 1,
            "03-02-2024": 1,
            "04-02-2024": 1,
            "10-02-2024": 1,
            "11-02-2024": 1,
            "17-02-2024": 1,
            "18-02-2024": 1,
            "24-02-2024": 1,
            "25-02-2024": 1,
            "02-03-2024": 1,
            "03-03-2024": 1,
            "09-03-2024": 1,
            "10-03-2024": 1,
            "16-03-2024": 1,
            "17-03-2024": 1,
            "23-03-2024": 1,
            "24-03-2024": 1,
            "30-03-2024": 1,
            "31-03-2024": 1,
            "06-04-2024": 1,
            "07-04-2024": 1,
            "13-04-2024": 1,
            "14-04-2024": 1,
            "20-04-2024": 1,
            "21-04-2024": 1,
            "27-04-2024": 1,
            "28-04-2024": 1,
            "04-05-2024": 1,
            "05-05-2024": 1,
            "11-05-2024": 1,
            "12-05-2024": 1,
            "18-05-2024": 1,
            "19-05-2024": 1,
            "25-05-2024": 1,
            "26-05-2024": 1,
            "01-06-2024": 1,
            "02-06-2024": 1,
            "08-06-2024": 1,
            "09-06-2024": 1,
            "15-06-2024": 1,
            "16-06-2024": 1,
            "22-06-2024": 1,
            "23-06-2024": 1,
            "29-06-2024": 1,
            "30-06-2024": 1,
            "06-07-2024": 1,
            "07-07-2024": 1,
            "13-07-2024": 1,
            "14-07-2024": 1,
            "20-07-2024": 1,
            "21-07-2024": 1,
            "27-07-2024": 1,
            "28-07-2024": 1,
            "03-08-2024": 1,
            "04-08-2024": 1,
            "10-08-2024": 1,
            "11-08-2024": 1,
            "17-08-2024": 1,
            "18-08-2024": 1,
            "24-08-2024": 1,
            "25-08-2024": 1,
            "31-08-2024": 1,
            "01-09-2024": 1,
            "07-09-2024": 1,
            "08-09-2024": 1,
            "14-09-2024": 1,
            "15-09-2024": 1,
            "21-09-2024": 1,
            "22-09-2024": 1,
            "28-09-2024": 1,
            "29-09-2024": 1,
            "05-10-2024": 1,
            "06-10-2024": 1,
            "12-10-2024": 1,
            "13-10-2024": 1,
            "19-10-2024": 1,
            "20-10-2024": 1,
            "26-10-2024": 1,
            "27-10-2024": 1,
            "02-11-2024": 1,
            "03-11-2024": 1,
            "09-11-2024": 1,
            "10-11-2024": 1,
            "16-11-2024": 1,
            "17-11-2024": 1,
            "23-11-2024": 1,
            "24-11-2024": 1,
            "30-11-2024": 1,
            "01-12-2024": 1,
            "07-12-2024": 1,
            "08-12-2024": 1,
            "14-12-2024": 1,
            "15-12-2024": 1,
            "21-12-2024": 1,
            "22-12-2024": 1,
            "28-12-2024": 1,
            "29-12-2024": 1
        };
        var holidayArr_ = [];
        for (var key in holidayArr) {
            holidayArr_.push(key);
        }

        function DisableDates(date) {
            var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
            return [holidayArr_.indexOf(string) == -1];
        }


        $(function() {
            var minD = "16-06-2023";
            var maxD = "17-06-2024";

            $("#dateImp").datepicker({
                changeYear: true,
                changeMonth: true,
                dateFormat: 'dd-mm-yy',
                minDate: minD,
                maxDate: maxD,
                ignoreReadonly: true,
                beforeShowDay: DisableDates
            });

            $("#dateExp").datepicker({
                changeYear: true,
                changeMonth: true,
                dateFormat: 'dd-mm-yy',
                minDate: minD,
                maxDate: maxD,
                ignoreReadonly: true,
                beforeShowDay: DisableDates
            });
        });
    </script>

    <script type="text/javascript" src="plugins/moment/moment.min.js"></script>
    <script type="text/javascript" src="plugins/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        //$("#information").modal('show');

        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                $('#startTimestamp').val(start.format('YYYY-MM-DD'));
                $('#endTimestamp').val(end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        var op = "";
        if (op) {
            document.getElementById("tfwdbid").style.opacity = 1.0;
            document.getElementById("tfwdask").style.opacity = 1.0;
            document.getElementById("t-bid-ask").style.opacity = 1.0;
            $('#d2b').removeClass("show-bg");
            $('#d2c').removeClass("show-bg");
            $('#no-more-tables2').removeClass("show-bg");
            $('#d2b').addClass("hide-bg");
            $('#d2c').addClass("hide-bg");
            $('#no-more-tables2').addClass("hide-bg");
        } else {
            document.getElementById("tfwdbid").style.opacity = 0.03;
            document.getElementById("tfwdask").style.opacity = 0.03;
            document.getElementById("t-bid-ask").style.opacity = 0.03;
            //$('.d2c').removeClass("hide-bg");
            $('#d2b').addClass("show-bg");
            $('#d2c').addClass("show-bg");
            $('#no-more-tables2').addClass("show-bg");
        }

        function findTomSpotBidData(pairSelTomBid) {
            var bid;
            var re = new RegExp('<' + 'font' + '[^><]*>|<.' + 'font' + '[^><]*>', 'g')
            var bodyText;

            switch (pairSelTomBid) {
                case '0':
                    document.getElementById('tspotRateBid').value = 0;
                    document.getElementById('tcashSpotBid').value = 0;
                    document.getElementById('tcashRateBid').value = 0;
                    document.getElementById('ttomSpotBid').value = 0;
                    document.getElementById('ttomRateBid').value = 0;
                    break;

                case '1':
                    bodyText = document.getElementById('inrToUSDbid').innerHTML;
                    bodyText = bodyText.replace(re, '');
                    bid = parseFloat(bodyText);
                    document.getElementById('tspotRateBid').value = bid.toFixed(4);
                    document.getElementById('tcashSpotBid').value = 0.0225;
                    document.getElementById('tcashRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
                    document.getElementById('ttomSpotBid').value = 0.0113;
                    document.getElementById('ttomRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
                    break;

                case '2':
                    bodyText = document.getElementById('inrToEURbid').innerHTML;
                    bodyText = bodyText.replace(re, '');
                    bid = parseFloat(bodyText);
                    document.getElementById('tspotRateBid').value = bid.toFixed(4);
                    document.getElementById('tcashSpotBid').value = 0.0305;;
                    document.getElementById('tcashRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
                    document.getElementById('ttomSpotBid').value = 0.0153;
                    document.getElementById('ttomRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
                    break;

                case '3':
                    bodyText = document.getElementById('inrToGBPbid').innerHTML;
                    bodyText = bodyText.replace(re, '');
                    bid = parseFloat(bodyText);
                    document.getElementById('tspotRateBid').value = bid.toFixed(4);
                    document.getElementById('tcashSpotBid').value = 0.031;;
                    document.getElementById('tcashRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
                    document.getElementById('ttomSpotBid').value = 0.0155;
                    document.getElementById('ttomRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
                    break;
            }

        }

        function findTomSpotAskData(pairSelTomAsk) {
            var ask;
            var re = new RegExp('<' + 'font' + '[^><]*>|<.' + 'font' + '[^><]*>', 'g')
            var bodyText;

            switch (pairSelTomAsk) {
                case '0':
                    document.getElementById('tspotRateAsk').value = 0;
                    document.getElementById('tcashSpotAsk').value = 0;
                    document.getElementById('tcashRateAsk').value = 0;
                    document.getElementById('ttomSpotAsk').value = 0;
                    document.getElementById('ttomRateAsk').value = 0;
                    break;

                case '1':
                    bodyText = document.getElementById('inrToUSDask').innerHTML;
                    bodyText = bodyText.replace(re, '');
                    ask = parseFloat(bodyText);
                    document.getElementById('tspotRateAsk').value = ask.toFixed(4);
                    document.getElementById('tcashSpotAsk').value = 0.0125;
                    document.getElementById('tcashRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
                    document.getElementById('ttomSpotAsk').value = 0.0063;
                    document.getElementById('ttomRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
                    break;

                case '2':
                    bodyText = document.getElementById('inrToEURask').innerHTML;
                    bodyText = bodyText.replace(re, '');
                    ask = parseFloat(bodyText);
                    document.getElementById('tspotRateAsk').value = ask.toFixed(4);
                    document.getElementById('tcashSpotAsk').value = 0.013;;
                    document.getElementById('tcashRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
                    document.getElementById('ttomSpotAsk').value = 0.0065;
                    document.getElementById('ttomRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
                    break;

                case '3':
                    bodyText = document.getElementById('inrToGBPask').innerHTML;
                    bodyText = bodyText.replace(re, '');
                    ask = parseFloat(bodyText);
                    document.getElementById('tspotRateAsk').value = ask.toFixed(4);
                    document.getElementById('tcashSpotAsk').value = 0.0135;;
                    document.getElementById('tcashRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
                    document.getElementById('ttomSpotAsk').value = 0.0068;
                    document.getElementById('ttomRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
                    break;
            }

        }

        $(documnent).ready(function(){
            $('#submit').click(){
                
                $('#reach_out_form').attr("data-target");
            }
            
        });
    </script>
     <script>
                    
       
    </script>
    <!--script>
    setInterval(function() {
      $.ajax({
        type: "GET",
        dataType: "json",
        data: {
          name: name
        },
        url: "crypto.php",
        success: function(data) {
             var inrrupee= $("#inrToUSD").text();

          $('#btc_sym').text(data.symbols[0].symbol);
          $('#btc_us').text(parseFloat(data.symbols[0].value).toFixed(2));
          $('#btc_in').text(parseFloat((data.symbols[0].value) * parseFloat(inrrupee)).toFixed(2));
          $('#eth_sym').text(data.symbols[1].symbol);
          $('#eth_us').text(parseFloat(data.symbols[1].value).toFixed(2));
          $('#eth_in').text(parseFloat((data.symbols[1].value) * parseFloat(inrrupee)).toFixed(2));
          $('#usdt_sym').text(data.symbols[2].symbol);
          $('#usdt_us').text(parseFloat(data.symbols[2].value).toFixed(2));
          $('#usdt_in').text(parseFloat((data.symbols[2].value) * parseFloat(inrrupee)).toFixed(2));
          $('#bnb_sym').text(data.symbols[3].symbol);
          $('#bnb_us').text(parseFloat(data.symbols[3].value).toFixed(2));
          $('#bnb_in').text(parseFloat((data.symbols[3].value) * parseFloat(inrrupee)).toFixed(2));
          $('#busd_sym').text(data.symbols[4].symbol);
          $('#busd_us').text(parseFloat(data.symbols[4].value).toFixed(2));
          $('#busd_in').text(parseFloat((data.symbols[4].value) * parseFloat(inrrupee)).toFixed(2));
          $('#xrp_sym').text(data.symbols[5].symbol);
          $('#xrp_us').text(parseFloat(data.symbols[5].value).toFixed(2));
          $('#xrp_in').text(parseFloat((data.symbols[5].value) * parseFloat(inrrupee)).toFixed(2));
          $('#ada_sym').text(data.symbols[6].symbol);
          $('#ada_us').text(parseFloat(data.symbols[6].value).toFixed(2));
          $('#ada_in').text(parseFloat((data.symbols[6].value) * parseFloat(inrrupee)).toFixed(2));
          $('#dot_sym').text(data.symbols[7].symbol);
          $('#dot_us').text(parseFloat(data.symbols[7].value).toFixed(2));
          $('#dot_in').text(parseFloat((data.symbols[7].value) * parseFloat(inrrupee)).toFixed(2));
          $('#sol_sym').text(data.symbols[8].symbol);
          $('#sol_us').text(parseFloat(data.symbols[8].value).toFixed(2));
          $('#sol_in').text(parseFloat((data.symbols[8].value) * parseFloat(inrrupee)).toFixed(2));
          $('#shib_sym').text(data.symbols[9].symbol);
          $('#shib_us').text(parseFloat(data.symbols[9].value).toFixed(2));
          $('#shib_in').text(parseFloat((data.symbols[9].value) * parseFloat(inrrupee)).toFixed(2));
          $('#doge_sym').text(data.symbols[10].symbol);
          $('#doge_us').text(parseFloat(data.symbols[10].value).toFixed(2));
          $('#doge_in').text(parseFloat((data.symbols[10].value) * parseFloat(inrrupee)).toFixed(2));
          $('#luna_sym').text(data.symbols[11].symbol);
          $('#luna_us').text(parseFloat(data.symbols[11].value).toFixed(2));
          $('#luna_in').text(parseFloat((data.symbols[11].value) * parseFloat(inrrupee)).toFixed(2));
        }
      });
    }, 500);
  </script-->
</body>

</html>