<?php
include_once('lib/database.php');
// if ($_SERVER['HTTPS'] != "on") {
//   $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//   header("Location: $url");
//   exit;
// }

if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
//   if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
//     echo 'Why you no have mysqli!!!';
// } else {
//     echo 'Day is saved!';
// }
error_reporting(E_ALL);

$allow = "";
if (isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  //$allow = $_SESSION['userallow']; 
}

$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";

// $conn = new mysqli($servername, $username, $password, $dbname);
$conn = OpenCon();

if ($conn->connect_error) {
  $err = "Error! Try again Later!";
} else {
  $succ = "Connection established";
}

$queryTom = "SELECT * FROM `cash-tom`";
$resultTom = $conn->query($queryTom);

$cashBidUsd = 0;
$cashBidEur = 0;
$cashBidGbp = 0;
$cashAskUsd = 0;
$cashAskEur = 0;
$cashAskGbp = 0;

$tomBidUsd = 0;
$tomBidEur = 0;
$tomBidGbp = 0;
$tomAskUsd = 0;
$tomAskEur = 0;
$tomAskGbp = 0;

while ($rowTom = $resultTom->fetch_assoc()) {
  switch ($rowTom['id']) {
    case '1':
      $cashBidUsd = $rowTom['cashBid'];
      $cashAskUsd = $rowTom['cashAsk'];
      $tomBidUsd = $rowTom['tomBid'];
      $tomAskUsd = $rowTom['tomAsk'];
      break;

    case '2':
      $cashBidEur = $rowTom['cashBid'];
      $cashAskEur = $rowTom['cashAsk'];
      $tomBidEur = $rowTom['tomBid'];
      $tomAskEur = $rowTom['tomAsk'];
      break;

    case '3':
      $cashBidGbp = $rowTom['cashBid'];
      $cashAskGbp = $rowTom['cashAsk'];
      $tomBidGbp = $rowTom['tomBid'];
      $tomAskGbp = $rowTom['tomAsk'];
      break;
  }
}

$query0 = "SELECT id, month, settleDate, bidPrem, askPrem, bidPremEUR, askPremEUR, bidPremGBP, askPremGBP FROM usdFwdRate";
$result0 = $conn->query($query0);
$arrayBid = array();
$arrayAsk = array();

$arrayBidEUR = array();
$arrayAskEUR = array();

$arrayBidGBP = array();
$arrayAskGBP = array();

$endSettleDate;

while ($row0 = $result0->fetch_assoc()) {

  $arrDateSettle = date("d-m-Y", strtotime($row0['settleDate']));
  $arrayBid[$arrDateSettle] = $row0['bidPrem'];
  $arrayAsk[$arrDateSettle] = $row0['askPrem'];

  $arrayBidEUR[$arrDateSettle] = $row0['bidPremEUR'];
  $arrayAskEUR[$arrDateSettle] = $row0['askPremEUR'];

  $arrayBidGBP[$arrDateSettle] = $row0['bidPremGBP'];
  $arrayAskGBP[$arrDateSettle] = $row0['askPremGBP'];

  $endSettleDate = date("d-m-Y", strtotime($row0['settleDate']));
}

//print_r($arrayBid);

$query = "SELECT holiday FROM holidays ORDER BY holiday ASC";
$result = $conn->query($query);

$d = 0;
$listHoliday = array();

while ($row = $result->fetch_assoc()) {
  $d++;
  $hd = $row['holiday'];
  $splitIt = explode("-", $hd);

  $newKey = $splitIt[2] . '-' . $splitIt[1] . '-' . $splitIt[0];

  $listHoliday[$newKey] = 1;
}

//print_r($listHoliday);

$conn->close();

if (isset($_POST['spotBidPrem-1'])) {
  $conn = OpenCon();
  //$conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    $err = "Error! Try again Later!";
  } else {
    $succ = "Connection established";
  }

  for ($i = 1; $i <= 12; $i++) {
    $settleDate = strval($_POST['spotSettleDt-' . $i]);

    $settleDateN = explode("-", $settleDate);
    $newKey = $settleDateN[2] . '-' . $settleDateN[1] . '-' . $settleDateN[0];

    $premBid = $_POST['spotBidPrem-' . $i];
    $premAsk = $_POST['spotAskPrem-' . $i];

    $sql = "UPDATE usdFwdRate SET settleDate='$newKey', bidPrem='$premBid', askPrem='$premAsk' WHERE id=$i";

    if ($conn->query($sql) === TRUE) {
      $succ = "Record updated successfully";
    } else {
      $err = "Error updating record: " . $conn->error;
    }
  }

  $conn->close();
}

$dateToday = new DateTime('today');
$tday = new DateTime('today');

$tday->format('d-m-Y');

$dt = new DateTime('today + 3 day');

function addMonth($day, $dt, $mt)
{
  $dt->modify('first day of +1 month');
  $dt->modify('+' . (min($day, $dt->format('t')) - $mt) . ' days');
  return $dt->format('d-m-Y');
}

function addDay($dt)
{
  $dt = new DateTime($dt);
  $dt->modify('+1 day');
  return $dt->format('d-m-Y');
}

function add3Days($dt)
{
  $dt->modify('+3 days');
  return $dt->format('d-m-Y');
}

function removeDay($dt)
{
  $dt = new DateTime($dt);
  $dt->modify('-1 day');
  return $dt->format('d-m-Y');
}

function addSimpleDay($dt)
{
  $dt = new DateTime($dt);
  $dt->modify('+1 day');
  return $dt;
}

$countSettleDt = 0;
$mainSettleDt = new DateTime('today');
$minDay = '';
$maxDay = '';

while ($countSettleDt < 2) {
  $mainSettleDt->modify('+1 day');

  if (array_key_exists($mainSettleDt->format('d-m-Y'), $listHoliday) == 1) {
  } else {
    $countSettleDt++;
  }
}

$arrDay = array();

$arrDay[0] = new DateTime($mainSettleDt->format('d-m-Y'));

for ($k = 0; $k < 12; $k++) {
  $tempArrDay0 = new DateTime($mainSettleDt->format('d-m-Y'));
  $m = $k + 1;
  $tempArrDay0->modify('+' . $m . ' month');

  $countSettleDt = 0;
  while (1) {
    if (array_key_exists($tempArrDay0->format('d-m-Y'), $listHoliday) == 1) {
      $tempArrDay0->modify('+1 day');
    } else {
      break;
    }
  }
  $arrDay[$k] = $tempArrDay0->format('d-m-Y');
}

$mainFwdStartDt = new DateTime($mainSettleDt->format('d-m-Y'));
$countFwdSDt = 0;
while ($countFwdSDt < 1) {
  $mainFwdStartDt->modify('+1 day');

  if (array_key_exists($mainFwdStartDt->format('d-m-Y'), $listHoliday) == 1) {
  } else {
    $countFwdSDt++;
  }
}

$dateToday = new DateTime('today');

function add365Days($dt)
{
  $dt->modify('+365 days');
  return $dt->format('Y-m-d');
}

$minDay = $mainFwdStartDt->format('d-m-Y');
$maxDay = $endSettleDate; //add365Days($dateToday);

include("check-FXPRESS.php");
?>

<!-- a helper script for vaidating the form-->
<script language="JavaScript" src="contact-form/script/gen_validatorv31.js" type="text/javascript"></script>

<div id='contact_form_errorloc' style="text-align:center; color:red;" class='err'></div>
<?php
if ($allowFC != "YES") {
?>
  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
    <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

    <title>fxpress</title>



    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font/tt-hoves/stylesheet.css">
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

    <!-- swiper (tanmoy) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <!-- swiper (tanmoy) -->

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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3HB1M04NFG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3HB1M04NFG');
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

    <?php include_once('include/top-menu.php'); ?>
      <div class="fxpress-ban" style="background-image: url(./images/fx-express/fx-ban.jpg);">
          <div class="container">
            <div class="fx-ban-slogan">
            <h1>FXpress(Forex Portal)by IBRLive is now available for <span class="flicker">2599/-</span>  only</h1>
                <p>"Customer satisfaction is our main
                    priority, and going above and beyond
                    their expectations is our ultimate goal in
                    developing this."
                </p>
                <a class="fx-bn-btn" href="#fx-prm-ar">Learn More</a>
            </div>
          </div>
      </div>
      <div class="fx-ban-bottom">
            <div class="container">
                <div class="fx-label-outer">
                    <img class="fx-lebel" src="images/fx-express/fx-label.png" alt="">
                    <div class="fx-label-cont">
                        <h2>How Do We Help Our Customer?</h2>
                    </div>
                </div>
                <div class="fx-video-area">
                    <video width="600" controls autoplay loop muted playsinline>
                        <source src="./images/fx-express/Ibr video.mp4">
                    </video>
                </div>
                <div class="fx-label-txt">
                    <h3>"Your Path to Empowered Currency Exchange and Financial Success"</h3>
                </div>
            </div>
      </div>
      <div class="fxpress-ban fx-success" style="background-image: url(./images/fx-express/fx-success-bg.jpg);">
            <div class="container">
                <div class="fx-ban-slogan">
                    <p>We are dedicated to assisting our
                        customers because we understand the
                        significance of smooth and informed
                        currency exchange.<br><span></span>
                        It is vital for us to empower our clients
                        with live interbank rates, forecasts, and
                        historical data to make sound decisions.<br><span></span>
                        Our Currency Calculator and SMS alerts
                        keep them up-to-date.<br><span></span>
                        We offer tailored solutions like forward
                        contract and RPC/PCFC management
                        tools, one-time FX rate negotiations, and
                        ROI optimizations. 
                    </p>
                </div>
            </div>
        </div>
        <div class="subscribe-area">
            <div class="container">
                <!-- <p>Our commitment lies in providing comprehensive support to simplify their exchange process and help them achieve their financial goals efficiently. Our customers' success is at the core of our mission, driving us to excel in delivering accurate information, valuable tools, and expert guidance.</p> -->
                <div class="text-center">
                    <a class="fx-subs-btn" href="/plans-and-pricing">subscribe</a>
                </div>
            </div>
        </div>
        <div class="fx-premium-area" id="fx-prm-ar">
            <div class="container">
                <div class="fx-prm-head">
                    <h2>UNLOCK THE PREMIUM BENEFITS WITH FXPRESS STANDARD PLAN</h2>
                </div>
                <div class="fx-premium-box-wrap">
                    <div class="row g-0">
                        <div class="col-lg-4 col-md-6">
                            <div class="fx-each-premium-box fx-gray-prm-box">
                                <h3>Live Interbank Exchange Rate</h3>
                                <ul>
                                    <li>Real Time Exchange rates changing in seconds</li>
                                    <li>View MID Market Rates, BID
                                        & Ask Rates, Days High &
                                        Low values.</li>
                                    <li>Empowers you to negotiate
                                        with your bank to get better
                                        exchange rate.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="fx-each-premium-box fx-green-prm-box">
                                <h3>Cash Tom Spot Rates</h3>
                                <ul>
                                    <li>Rates are available for all
                                        Cash Tom & Spot values.</li>
                                    <li>Facilitates wise decisions to
                                        book Cash, Tom or Spot
                                        Rate.</li>
                                    <li>Every penny counts.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="fx-each-premium-box fx-blue-prm-box">
                                <h3>Currency Forecast</h3>
                                <ul>
                                    <li>Daily, Weekly and Monthly
                                        Forecasts by experts in
                                        currency trading.</li>
                                    <li>More than 70% accurate
                                        forecasts.</li>
                                    <li>We analyse the market 24 X 7.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="fx-each-premium-box fx-gray-prm-box">
                                <h3>Forward Contract Management Tool</h3>
                                <ul>
                                    <li>Tool to calculate actual profit
                                        & loss for booked contracts.</li>
                                    <li>Maintain records of all
                                        ongoing and completed
                                        contracts.</li>
                                    <li>Reduces the hassle of
                                        maintaining excel.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="fx-each-premium-box fx-green-prm-box">
                                <h3>Monthly & Broken
                                    Date Forward Rate</h3>
                                <ul>
                                    <li>Month wise forward
                                        Rates/Broken date forward
                                        rates are available.</li>
                                    <li>Empowers you to negotiate
                                        for fair premium with your
                                        bank.</li>
                                    <li>Offers immense savings.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="fx-each-premium-box fx-blue-prm-box">
                                <h3>Others</h3>
                                <ul>
                                    <li>Currency Calculator</li>
                                    <li>Historical Rates</li>
                                    <li>Day opening and closing SMS</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fx-whyus-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="fx-prm-head">
                            <h2>WHY US?</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="fx-each-whyus-box">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="fx-each-whyus-img">
                                    <img class="w-100" src="images/fx-express/fx-why-1.png" alt="">
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="fx-each-whyus-txt">
                                        <ul>
                                            <li>Helps you record and monitor your
                                                underlying exposure and respective
                                                hedges at real time.</li>
                                            <li>Negotiate with your bank for better
                                                exchange rates and forward premiums
                                                to maximize your profits.</li>
                                            <li>Helps you to build a risk management
                                                Policy which consist of what, how and
                                                when to hedge the currency exposure.</li>
                                            <li>
                                                Provides you forward contract
                                                management tool to record and monitor
                                                your ongoing and historical contracts. Also shows the actual profit & loss for each
                                                contract.</li>
                                        </ul>
                                    </div>
                                </div>
                        </div>
                        
                    </div>
                    <div class="fx-each-whyus-box">
                        <div class="row flex-row-reverse align-items-center">
                            <div class="col-md-6">
                                <div class="fx-each-whyus-img">
                                    <img class="w-100" src="images/fx-express/fx-why-2.png" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fx-each-whyus-txt">
                                    <ul>
                                       <li>Provides you packing credit
                                        management tool to record and monitor your ongoing and completed packing
                                        credit disbursements. Notifies you for
                                        upcoming due dates for PC.</li>
                                       <li>Guides you to do natural hedge through PCFC and opposite side exposures.</li>
                                       <li>Provides you accurate currency
                                        forecasts on daily, weekly & monthly
                                        basis.</li>
                                       <li>Minimize your interest cost by
                                        converting your domestic long term
                                        borrowings into foreign currency
                                        borrowings.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="fx-subs-btn" href="/plans-and-pricing">subscribe</a>
                </div>

            </div>
        </div>
        <div class="fx-feedback-area" style="background-image: url(./images/fx-express/fx-feedback-bg.jpg);">
            <div class="container">
                <div class="fx-feedback-head text-center">
                    <h2>Feedback from Clients</h2>
                    <h3>"Savings That Add Up: Choose Us to Save Lacs!"</h3>
                </div>
                <div class="fx-feedback-slider">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <div class="fx-each-feedback-box">
                                <p>I have been using the portal
                                    for almost 2 months (since
                                    November 2021) now. The rates shown on the screen matches
                                    exact with the banker screen
                                    and it had helped me so much
                                    to cover the exchange rate
                                    difference that I've been paying
                                    to banks from last so many years.</p>
                                <div class="fx-fd-circle">
                                    <img src="images/fx-express/fd-circle-1.png" alt="">
                                    <div class="fx-fd-circle-txt">
                                        <h5>Abhishek Gupta</h5>
                                        <p>Weavetex Exports</p>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="swiper-slide">
                            <div class="fx-each-feedback-box">
                                <p> We are using the facility since almost last one year. The rates quoted are genuine and matches with the rates offered by various banks. Due to the support we
                                    are able to hedge our forex
                                    exposures.</p>
                                <div class="fx-fd-circle">
                                    <img src="images/fx-express/fd-circle-2.png" alt="">
                                    <div class="fx-fd-circle-txt">
                                        <h5>Sahil Sharma</h5>
                                        <p>Javi Home Pvt. Ltd.</p>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="swiper-slide">
                            <div class="fx-each-feedback-box">
                                <p>In just one small transaction,
                                    I could manage to save money equivalent to 6 years of your
                                    website subscription fees.
                                    Thanks a lot for all the help
                                    and support during my first
                                    transaction and in negotiating with my bank</p>
                                <div class="fx-fd-circle">
                                    <img src="images/fx-express/fd-circle-3.png" alt="">
                                    <div class="fx-fd-circle-txt">
                                        <h5>Animesh Kumar</h5>
                                        <p>Virtue International</p>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="swiper-slide">
                            <div class="fx-each-feedback-box">
                                <p>I have been using the portal
                                    for almost 2 months (since
                                    November 2021) now. The rates shown on the screen matches
                                    exact with the banker screen
                                    and it had helped me so much
                                    to cover the exchange rate
                                    difference that I've been paying
                                    to banks from last so many years.</p>
                                <div class="fx-fd-circle">
                                    <img src="images/fx-express/fd-circle-1.png" alt="">
                                    <div class="fx-fd-circle-txt">
                                        <h5>Abhishek Gupta</h5>
                                        <p>Weavetex Exports</p>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                
            </div>
        </div>
        <div class="fx-faq-area" style="background-image: url(../html/images/about-middle-bg.webp);">
            <div class="container">
                <h2>Frequently Asked Questions</h2>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          <h3>How do you provide live interbank exchange rates?</h3>
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p>We have established partnerships with trusted financial institutions and sources that provide real-time data on interbank exchange rates. Our advanced technology allows us to aggregate and display these rates in real-time on our platform.</p></div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          <h3>Are your interbank rates accurate?</h3>
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p>Yes, our interbank rates are highly accurate. We take pride in ensuring that the rates we provide are reliable and up-to-date. Our platform uses sophisticated algorithms to verify and match the rates displayed with the rates available on bank screens.</p></div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                          <h3>Can I trust the rates displayed on your website?</h3>
                        </button>
                      </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p>Absolutely! Our rates are derived from reputable and trusted sources, and we have strict quality control measures in place to ensure their accuracy. We strive to maintain transparency and provide you with the most reliable exchange rate information.</p></div>
                      </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            <h3>How often are the rates updated?</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>Our rates are updated in real-time. You can be confident that the rates you see on our website are current and reflect the dynamic nature of the foreign exchange market.</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFour">
                            <h3>How can your accurate interbank exchange rate information benefit me as an importer/exporter?</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>By having access to accurate interbank rates, you gain a competitive edge in negotiations with banks. You can use this information to secure more favorable rates on your international transactions, potentially saving significant amounts on currency conversion costs.</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingSix">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                            <h3>What are forward premiums, and how can they help me save on exchange margins?</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>Forward premiums refer to the difference between the spot exchange rate and the forward exchange rate. With our information on accurate forward premiums prevailing in the market, you can negotiate for the right premium on your forward contract bookings. This allows you to minimize exchange rate risks and optimize your financial decisions.</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingSeven">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                            <h3>How reliable are your currency forecasts, and how can they assist my business decisions?</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>Our currency forecasts are known for their impressive accuracy, with a track record of over 70%. These forecasts are valuable tools for making informed business decisions, especially for importers and exporters who need to plan and budget effectively amidst currency fluctuations.</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingEight">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                            <h3>Are there any success stories or testimonials from your satisfied customers?</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>Yes, we have numerous success stories and testimonials from satisfied customers who have benefited from our accurate exchange rate information and currency forecasts. These testimonials highlight the positive impact our services have had on their businesses and financial decisions.</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingNine">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                            <h3>What is forward management tool?
                                Features of the tool:-</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>Recording of booked forward contracts in digital form.
                            Provides real time profit and loss on any booked contract
                            Calculate Swap points on early utilization and profit and loss on cancellation of forward contract.
                            Notifies about contracts being due or expiring.
                            Full and partial utilization of contract available
                            Maintains historical data of all the contracts</p></div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTen">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                            <h3>Can I book rate on your portal?</h3>
                          </button>
                        </h2>
                        <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><p>No, you cannot book rate on our portal but you can get the real time information related to currency rates to negotiate better rates with your bank.</p></div>
                        </div>
                    </div>
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

  <!-- swiper (tanmoy) -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".fx-feedback-area .mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      clickable: true,
      autoplay: {
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
        },
      navigation: {
        nextEl: ".fx-feedback-area .swiper-button-next",
        prevEl: ".fx-feedback-area .swiper-button-prev",
      },
      breakpoints: {
		320: {
			slidesPerView: 1,
			spaceBetween: 0,
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 20,
		},
		1024: {
			slidesPerView: 3,
			spaceBetween: 30,
		},
	},
    });



    document.addEventListener('DOMContentLoaded', function(){
  var videoElem = document.querySelector('video');
  var toggleMuted = document.querySelector('.toggleMuted');
  toggleMuted.addEventListener('click', function(){
      videoElem.muted ^= 1;
  }, false);
}, false);
  </script>

   <!-- swiper (tanmoy) -->
</body>

</html>
<?php
} else {
?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
    <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

    <title>Home | IBR Live</title>

    <?php include_once('include/head.php'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="calculations.js"></script>
  <![endif]-->



    <style>
	.numeric h4{
font-size: 15px !important;
}

      .rwd-media {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
        /* 16:9 */
      }

      .rwd-media iframe,
      .rwd-media video {
        position: absolute;
        width: 100%;
        height: 100%;
      }

      #d2c.show-bg {
        background: url("https://ibrlive.com/images/login-required.png") !important;
        background-size: 100% 100% !important;
      }

      #d2c.hide-bg {
        background-image: none !important;
        background: transparent !important;
      }

      #d2b.show-bg {
        background: url("https://ibrlive.com/images/login-required.png") !important;
        background-size: 100% 100% !important;
      }

      #d2b.hide-bg {
        background-image: none !important;
        background: transparent !important;
      }

      #no-more-tables2.show-bg {
        background: url("https://ibrlive.com/images/login-required.png") !important;
        background-size: 100% 100% !important;
      }

      #no-more-tables2.hide-bg {
        background-image: none !important;
        background: transparent !important;
      }

      th.ui-datepicker-week-end,
      td.ui-datepicker-week-end {
        display: none;
      }

      input[type=date]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
      }

      .img-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }

      .modal-wide {
        width: 90%;
      }

      .carousel-indicators .active {
        background: #31708f;
      }


      .adjust1 {
        float: left;
        width: 100%;
        margin-bottom: 0;
      }

      .adjust2 {
        margin: 0;
      }

      .carousel-indicators li {
        border: 1px solid #ccc;
      }

      .carousel-control {
        color: #31708f;
        width: 5%;
      }

      .carousel-control:hover,
      .carousel-control:focus {
        color: #31708f;
      }

      .carousel-control.left,
      .carousel-control.right {
        background-image: none;
      }

      .media-object {
        margin: auto;
        margin-top: 15%;
      }

      @media screen and (max-width: 768px) {
        .media-object {
          margin-top: 0;
        }
      }

      .card {
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 6px;
      }

      .card>.card-link {
        color: #333;
      }

      .card>.card-link:hover {
        text-decoration: none;
      }

      .card>.card-link .card-img img {
        border-radius: 6px 6px 0 0;
      }

      .card .card-img {
        position: relative;
        padding: 0;
        display: table;
      }

      .card .card-img .card-caption {
        position: absolute;
        right: 0;
        bottom: 16px;
        left: 0;
      }

      .card .card-body {
        display: table;
        width: 100%;
        padding: 12px;
      }

      .card .card-header {
        border-radius: 6px 6px 0 0;
        padding: 8px;
      }

      .card .card-footer {
        border-radius: 0 0 6px 6px;
        padding: 8px;
      }

      .card .card-left {
        position: relative;
        float: left;
        padding: 0 0 8px 0;
      }

      .card .card-right {
        position: relative;
        float: left;
        padding: 8px 0 0 0;
      }

      .card .card-body h1:first-child,
      .card .card-body h2:first-child,
      .card .card-body h3:first-child,
      .card .card-body h4:first-child,
      .card .card-body .h1,
      .card .card-body .h2,
      .card .card-body .h3,
      .card .card-body .h4 {
        margin-top: 0;
      }

      .card .card-body .heading {
        display: block;
      }

      .card .card-body .heading:last-child {
        margin-bottom: 0;
      }

      .card .card-body .lead {
        text-align: center;
      }

      @media(min-width: 768px) {
        .card .card-left {
          float: left;
          padding: 0 8px 0 0;
        }

        .card .card-right {
          float: left;
          padding: 0 0 0 8px;
        }

        .card .card-4-8 .card-left {
          width: 33.33333333%;
        }

        .card .card-4-8 .card-right {
          width: 66.66666667%;
        }

        .card .card-5-7 .card-left {
          width: 41.66666667%;
        }

        .card .card-5-7 .card-right {
          width: 58.33333333%;
        }

        .card .card-6-6 .card-left {
          width: 50%;
        }

        .card .card-6-6 .card-right {
          width: 50%;
        }

        .card .card-7-5 .card-left {
          width: 58.33333333%;
        }

        .card .card-7-5 .card-right {
          width: 41.66666667%;
        }

        .card .card-8-4 .card-left {
          width: 66.66666667%;
        }

        .card .card-8-4 .card-right {
          width: 33.33333333%;
        }
      }

      /* -- default theme ------ */
      .card-default {
        border-color: #ddd;
        background-color: #fff;
        margin-bottom: 24px;
      }

      .card-default>.card-header,
      .card-default>.card-footer {
        color: #333;
        background-color: #ddd;
      }

      .card-default>.card-header {
        border-bottom: 1px solid #ddd;
        padding: 8px;
      }

      .card-default>.card-footer {
        border-top: 1px solid #ddd;
        padding: 8px;
      }

      .card-default>.card-body {}

      .card-default>.card-img:first-child img {
        border-radius: 6px 6px 0 0;
      }

      .card-default>.card-left {
        padding-right: 4px;
      }

      .card-default>.card-right {
        padding-left: 4px;
      }

      .card-default p:last-child {
        margin-bottom: 0;
      }

      .card-default .card-caption {
        color: #fff;
        text-align: center;
        text-transform: uppercase;
      }

      .container sectionImg {
        color: #000000;
        padding: 10px 0;
        background-size: 100%;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        height: 300px;
      }

      .iconWrapper {
        display: table;
        width: 50px;
        height: 50px;
        border-radius: 999px;
        background-color: #00c0ef;
      }

      .iconWrapper i {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
      }

      .iconWrapper-large {
        display: table;
        width: 150px;
        height: 150px;
        border-radius: 999px;
        background-color: #00c0ef;
      }

      .iconWrapper-large i {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
      }

      .iconWrapper-trans {
        display: table;
        width: 150px;
        height: 150px;
        border-radius: 999px;
        background-color: none;
      }

      .iconWrapper-trans i {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
      }

      .parent {
        display: table;
      }

      .child {
        display: table-cell;
        vertical-align: middle;
        padding-left: 20px;
      }
    </style>

    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/daterangepicker/daterangepicker.css" />

    <script>
      var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
      var bidArray = <?php echo json_encode($arrayBid); ?>;
      var askArray = <?php echo json_encode($arrayAsk); ?>;
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
          bidArray = <?php echo json_encode($arrayBid); ?>;
        } else if (n == 2) {
          bodyText = document.getElementById("inrToEURbid").innerHTML;
          bidArray = <?php echo json_encode($arrayBidEUR); ?>;
        } else if (n == 3) {
          bodyText = document.getElementById("inrToGBPbid").innerHTML;
          bidArray = <?php echo json_encode($arrayBidGBP); ?>;
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

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
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

        var askArray = <?php echo json_encode($arrayAsk); ?>;

        if (n == 1) {
          bodyText = document.getElementById("inrToUSDask").innerHTML;
          askArray = <?php echo json_encode($arrayAsk); ?>;
        } else if (n == 2) {
          bodyText = document.getElementById("inrToEURask").innerHTML;
          askArray = <?php echo json_encode($arrayAskEUR); ?>;
        } else if (n == 3) {
          bodyText = document.getElementById("inrToGBPask").innerHTML;
          askArray = <?php echo json_encode($arrayAskGBP); ?>;
        } else {
          return;
        }

        bodyText = bodyText.replace(re, '');
        ask = parseFloat(bodyText);

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
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

        var bidArray = <?php echo json_encode($arrayBid); ?>;

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
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

        var askArray = <?php echo json_encode($arrayAsk); ?>;

        var fs = <?php echo json_encode($mainFwdStartDt->format('Y-m-d')); ?>;
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
              if (document.getElementById('monthcurrency').value == 1) {
                var o = parseFloat(t[2]).toFixed(4),
                  n = parseFloat(t[3]).toFixed(4),
                  a = 0;

                if (o != parseFloat(document.getElementById('spotbidmonth').textContent).toFixed(4)) {
                  document.getElementById("spotbidmonth").style.backgroundColor = "#FAE5D3"
                }

                if (n != parseFloat(document.getElementById('askbidmonth').textContent).toFixed(4)) {
                  document.getElementById("askbidmonth").style.backgroundColor = "#FAE5D3"
                }

                (document.getElementById('spotbidmonth').textContent = parseFloat(o).toFixed(4)),

                (document.getElementById('askbidmonth').textContent = parseFloat(n).toFixed(4)),


                $('.spotbidme').each(function() {



                  this.parentNode.children[3].style.display = "none";
                  this.parentNode.children[4].style.display = "none";
                  this.parentNode.children[5].style.display = "none";
                  this.parentNode.children[6].style.display = "none";
                  this.parentNode.children[1].style.display = "table-cell";
                  this.parentNode.children[2].style.display = "table-cell";
                  var monthhhh = this.parentNode.children[0].textContent;

                  var spotbid = this.parentNode.children[2].textContent;
                  var finalBid = parseFloat(parseFloat(o) + parseFloat(this.textContent) / 100).toFixed(4);
                  var finalAsk = parseFloat(parseFloat(n) + parseFloat(spotbid) / 100).toFixed(4);
                  if (finalBid > this.parentNode.children[7].textContent) {
                    this.parentNode.children[7].style.backgroundColor = 'green';
                  }
                  if (finalBid < this.parentNode.children[7].textContent) {
                    this.parentNode.children[7].style.backgroundColor = 'red';
                  }

                  if (finalAsk > this.parentNode.children[8].textContent) {
                    this.parentNode.children[8].style.backgroundColor = 'green';
                  }
                  if (finalAsk < this.parentNode.children[8].textContent) {
                    this.parentNode.children[8].style.backgroundColor = 'red';
                  }



                  this.parentNode.children[7].textContent = finalBid
                  this.parentNode.children[8].textContent = finalAsk

                  this.parentNode.children[9].textContent = parseFloat((parseFloat(this.textContent / 100) / parseFloat(o) * (100)) * 12 / parseInt(monthhhh)).toFixed(4);
                  this.parentNode.children[10].textContent = parseFloat((parseFloat(spotbid / 100) / parseFloat(n) * (100)) * 12 / parseInt(monthhhh)).toFixed(4);

                });

              }
              if (document.getElementById('monthcurrency').value == 2) {
                var o = parseFloat(t[12]).toFixed(4),
                  n = parseFloat(t[13]).toFixed(4),
                  a = 0;
                if (o != parseFloat(document.getElementById('spotbidmonth').textContent).toFixed(4)) {
                  document.getElementById("spotbidmonth").style.backgroundColor = "#FAE5D3"
                }
                if (n != parseFloat(document.getElementById('askbidmonth').textContent).toFixed(4)) {
                  document.getElementById("askbidmonth").style.backgroundColor = "#FAE5D3"
                }


                (document.getElementById('spotbidmonth').textContent = parseFloat(o).toFixed(4)),
                (document.getElementById('askbidmonth').textContent = parseFloat(n).toFixed(4)),


                $('.spotbidmee').each(function() {

                  this.parentNode.children[1].style.display = "none";
                  this.parentNode.children[2].style.display = "none";
                  this.parentNode.children[5].style.display = "none";
                  this.parentNode.children[6].style.display = "none";
                  this.parentNode.children[3].style.display = "table-cell";
                  this.parentNode.children[4].style.display = "table-cell";



                  var monthhhh = this.parentNode.children[0].textContent;

                  var spotbid = this.parentNode.children[4].textContent;

                  var finalBid = parseFloat(parseFloat(o) + parseFloat(this.textContent) / 100).toFixed(4);
                  var finalAsk = parseFloat(parseFloat(n) + parseFloat(spotbid) / 100).toFixed(4);
                  if (finalBid > this.parentNode.children[7].textContent) {
                    this.parentNode.children[7].style.backgroundColor = 'green';
                  }
                  if (finalBid < this.parentNode.children[7].textContent) {
                    this.parentNode.children[7].style.backgroundColor = 'red';
                  }

                  if (finalAsk > this.parentNode.children[8].textContent) {
                    this.parentNode.children[8].style.backgroundColor = 'green';
                  }
                  if (finalAsk < this.parentNode.children[8].textContent) {
                    this.parentNode.children[8].style.backgroundColor = 'red';
                  }



                  this.parentNode.children[7].textContent = finalBid
                  this.parentNode.children[8].textContent = finalAsk

                  this.parentNode.children[9].textContent = parseFloat((parseFloat(this.textContent / 100) / parseFloat(o) * (100)) * 12 / parseInt(monthhhh)).toFixed(4);
                  this.parentNode.children[10].textContent = parseFloat((parseFloat(spotbid / 100) / parseFloat(n) * (100)) * 12 / parseInt(monthhhh)).toFixed(4);

                });

              }
              if (document.getElementById('monthcurrency').value == 3) {
                var o = parseFloat(t[22]).toFixed(4),
                  n = parseFloat(t[23]).toFixed(4),
                  a = 0;
                if (o != parseFloat(document.getElementById('spotbidmonth').textContent).toFixed(4)) {
                  document.getElementById("spotbidmonth").style.backgroundColor = "#FAE5D3"
                }
                if (n != parseFloat(document.getElementById('askbidmonth').textContent).toFixed(4)) {
                  document.getElementById("askbidmonth").style.backgroundColor = "#FAE5D3"
                }


                (document.getElementById('spotbidmonth').textContent = parseFloat(o).toFixed(4)),
                (document.getElementById('askbidmonth').textContent = parseFloat(n).toFixed(4)),


                $('.spotbidmeg').each(function() {
                  this.parentNode.children[1].style.display = "none";
                  this.parentNode.children[2].style.display = "none";
                  this.parentNode.children[3].style.display = "none";
                  this.parentNode.children[4].style.display = "none";
                  this.parentNode.children[5].style.display = "table-cell";
                  this.parentNode.children[6].style.display = "table-cell";


                  var monthhhh = this.parentNode.children[0].textContent;

                  var spotbid = this.parentNode.children[6].textContent;

                  var finalBid = parseFloat(parseFloat(o) + parseFloat(this.textContent) / 100).toFixed(4);
                  var finalAsk = parseFloat(parseFloat(n) + parseFloat(spotbid) / 100).toFixed(4);
                  if (finalBid > this.parentNode.children[7].textContent) {
                    this.parentNode.children[7].style.backgroundColor = 'green';
                  }
                  if (finalBid < this.parentNode.children[7].textContent) {
                    this.parentNode.children[7].style.backgroundColor = 'red';
                  }

                  if (finalAsk > this.parentNode.children[8].textContent) {
                    this.parentNode.children[8].style.backgroundColor = 'green';
                  }
                  if (finalAsk < this.parentNode.children[8].textContent) {
                    this.parentNode.children[8].style.backgroundColor = 'red';
                  }



                  this.parentNode.children[7].textContent = finalBid
                  this.parentNode.children[8].textContent = finalAsk
                  this.parentNode.children[9].textContent = parseFloat((parseFloat(this.textContent / 100) / parseFloat(o) * (100)) * 12 / parseInt(monthhhh)).toFixed(4);
                  this.parentNode.children[10].textContent = parseFloat((parseFloat(spotbid / 100) / parseFloat(n) * (100)) * 12 / parseInt(monthhhh)).toFixed(4);

                });

              }



              setTimeout(function() {

                (document.getElementById("spotbidmonth").style.backgroundColor = "white"),
                (document.getElementById("askbidmonth").style.backgroundColor = "white"),
                $('.spotbidmeg').each(function() {
                  this.parentNode.children[7].style.backgroundColor = 'white';
                  this.parentNode.children[8].style.backgroundColor = 'white';


                })

              }, 1e3);
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
    </script>

  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

  <body onload="rcvData();">
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
      <div class="spinner"></div>
    </div>
    <div class="container-fluid position-relative p-0 head-nav">
      <?php include_once('include/top-menu.php'); ?>

      <div id="header-carousel" class="slide-header">
        <div class="p-3" style="max-width: 900px; margin: 0 auto;">
          <h4 class="display-3 text-white mb-md-4 animated zoomIn">Forward Rates</h4>
        </div>
      </div>
    </div>

    <!--<div class="container">
    <section class="wrapper">

            <h1 style="color: white;">IBRLive is cool.</h1>

    </section>
</div> -->
    <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
      <div class="col-md-8" style="margin-top: 10px;display:none;">
        <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="box-header" align=center>
            <i class="fa fa-money"></i>
            <p class="box-title" style="font-size: 22px;"><b>Live Currency Rates </p>
            <font style="font-size: 16px;"></b></font>
          </div>
          <div class="box-body pad table-responsive" id="no-more-tables">

            <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed">
              <thead class="cf">
                <tr>
                  <th class="numeric">
                    <h4><b>Quote Currency</b></h4>
                  </th>
                  <th colspan="3" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;" />
                    <h4 style="display:inline;"> <b>INR (&#8377;)</b></h4>
                    </h4>
                  </th>
                </tr>
                <tr>
                  <th class="numeric">
                    <h4><b>Base Currency</b></h4>
                  </th>
                  <th class="numeric">
                    <h4><b>LIVE RATES <br />(Mid Values) (&#8377;)</b></h4>
                  </th>

                  <th class="numeric">
                    <h4><b>HIGH (&#8377;)</b></h4>
                  </th>
                  <th class="numeric">
                    <h4><b>LOW (&#8377;)</b></h4>
                  </th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;" /> 1 USD (&#36;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToUSD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToUSDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToUSDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;" /> 1 EUR (&#8364;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToEUR"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToEURhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToEURlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;" /> 1 GBP (&#163;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToGBP"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToGBPhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToGBPlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;" /> 1 AUD (&#36;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToAUD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToAUDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToAUDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;" /> 1 CAD (&#36;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToCAD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToCADhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToCADlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;" /> 1 NZD (&#36;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToNZD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToNZDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToNZDlow"></td>
                </tr>

                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;" /> 1 AED (&#1583;.&#1573;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToAED"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToAEDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToAEDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;" /> 1 SGD (&#36;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToSGD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToSGDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToSGDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;" /> 1 THB (&#3647;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToTHB"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToTHBhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToTHBlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <h4><b><img src="images/flags/CNY.png" style="display: inline; width: 30px; height: auto;" /> 1 CNY (&#20803;)</b></h4>
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToCNY"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToCNYhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToCNYlow"></td>
                </tr>
                <tr>
                  <td colspan="4">
                    <h5><b>Real Time Exchange Rates ( Mid Market Values)</b><br />
                      Real Time Exchange rates (Mid Market Rates/Interbank Rates/Spot rates)- Mid Market rates are average of buy & sell transactional rates of a currency pair. <br />These rates are just for reference purpose and not for transaction purpose.</h5>
                  </td>
                </tr>
              <tbody>

            </table>

          </div><!-- /.box -->

        </div>
      </div><!-- /.col -->


      <?php
      $row_date = strtotime('31-01-2021');
      $today = strtotime(date('Y-m-d'));

      if ($row_date >= $today) {
      ?>
        <div class="col-md-12 text-center" style="margin-top: 10px;">
          <a href="https://ibrlive.com/foreign-exchange-test"><img class="img-responsive img-center" src="images/ads/ad-01.png" /></a>
        </div>
      <?php
      }
      ?>
      <?php
      if ($allowFC != "YES") {
      ?>
        <div class="col-md-12" style="margin-top: 10px; display:none;">
          <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="box-header" align=center>

              <p class="box-title" style="font-size: 22px;"><i class="fa fa-bullseye"></i> <b>FXPRESS by IBRLive <a href="https://ibrlive.com/register">
                    <font style="color: green;">(Register now to start 10 Days Free Trial!)</font>
                  </a></b></p>
            </div>

            <div class="box-body" align=center>

              <div class="col col-lg-4 text-center" style="background: #fff; ">
                <div class="h-100 p-2 rounded-3 position-relative"><iframe style="width:100%; height: 100%;" src="https://www.youtube.com/embed/7YRYQRNNtMg?rel=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
              </div>

              <div class="col col-lg-8 text-center" style="margin-bottom: 10px;">
                <h4 class="bg-danger" style="padding: 5px;"><i>Exporter or Importer?</i></h4>
                <h4 class="bg-info" style="padding: 5px;"><i>Paying Heavy Exchange Margin on currency conversion?</i></h4>
                <h4 class="bg-success" style="padding: 5px;"><i>
                    If Yes, then you are at right place to put hold on your increasing financial cost</i></h4>
                <hr>

                <a href="fxpress"><button type="button" style="margin-top:5px;" class="btn btn-success"><i class="fa fa-info-circle"></i> Click for more information! </button></a>

                <a href="our-products" style="margin-top:5px;"><button type="button" style="margin-top:5px;" class="btn btn-warning"> <i class="fa fa-angle-double-right"></i> Subscribe to FXPRESS Now! </button></a>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

      <?php
      if ($allowFC != "YES") {
      ?>
        <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s">
          <div class="container">

            <i class="fa fa-money"></i>
            <p class="box-title" style="font-size: 22px;"><b>Cash Tom Spot Rate</p>
            <font style="font-size: 16px;"></b></font>
          </div>
          <!-- /.box-header -->
          <div class="container">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Currency Pair (Bid)</label>
                  <select id="pairSelTomBid" onclick="findTomSpotBidData(this.value)" class="form-control select2" style="width: 100%;">

                    <!--<option value="0">SELECT PAIR</option>-->
                    <option value="1" selected>USD/INR</option>
                    <option value="2">EUR/INR</option>
                    <option value="3">GBP/INR</option>
                  </select>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Spot Rate</label>
                  <input value=0 type="text" class="form-control" name="tspotRateBid" id="tspotRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Spot</label>
                  <input value=0 type="text" class="form-control" name="tcashSpotBid" id="tcashSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Rate</label>
                  <input value=0 type="text" class="form-control" name="tcashRateBid" id="tcashRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Spot</label>
                  <input value=0 type="text" class="form-control" name="ttomSpotBid" id="ttomSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Rate</label>
                  <input value=0 type="text" class="form-control" name="ttomRateBid" id="ttomRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <hr>

            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Currency Pair (Ask)</label>
                  <select id="pairSelTomAsk" onclick="findTomSpotAskData(this.value)" class="form-control select2" style="width: 100%;">
                    <!--<option value="0">SELECT PAIR</option>-->
                    <option value="1" selected>USD/INR</option>
                    <option value="2">EUR/INR</option>
                    <option value="3">GBP/INR</option>
                  </select>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Spot Rate</label>
                  <input value=0 type="text" class="form-control" name="tspotRateAsk" id="tspotRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Spot</label>
                  <input value=0 type="text" class="form-control" name="tcashSpotAsk" id="tcashSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Rate</label>
                  <input value=0 type="text" class="form-control" name="tcashRateAsk" id="tcashRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Spot</label>
                  <input value=0 type="text" class="form-control" name="ttomSpotAsk" id="ttomSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Rate</label>
                  <input value=0 type="text" class="form-control" name="ttomRateAsk" id="ttomRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div>
          <!-- /.box-body -->

        </div> <!-- /.tom-spot -->
      <?php
      } else {
      ?>
        <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s">
          <div class="container">

            <i class="fa fa-money"></i>
            <p class="box-title" style="font-size: 22px;"><b>Cash Tom Spot Rate</p>
            <font style="font-size: 16px;"></b></font>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Currency Pair (Bid)</label>
                  <select id="pairSelTomBid" onclick="findTomSpotBidData(this.value)" class="form-control select2" style="width: 100%;">
                    <!--<option value="0">SELECT PAIR</option>-->
                    <option value="1" selected>USD/INR</option>
                    <option value="2">EUR/INR</option>
                    <option value="3">GBP/INR</option>
                  </select>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Spot Rate</label>
                  <input value=0 type="text" class="form-control" name="tspotRateBid" id="tspotRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Spot</label>
                  <input value=0 type="text" class="form-control" name="tcashSpotBid" id="tcashSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Rate</label>
                  <input value=0 type="text" class="form-control" name="tcashRateBid" id="tcashRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Spot</label>
                  <input value=0 type="text" class="form-control" name="ttomSpotBid" id="ttomSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Rate</label>
                  <input value=0 type="text" class="form-control" name="ttomRateBid" id="ttomRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <hr>

            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Currency Pair (Ask)</label>
                  <select id="pairSelTomAsk" onclick="findTomSpotAskData(this.value)" class="form-control select2" style="width: 100%;">
                    <!--<option value="0">SELECT PAIR</option>-->
                    <option value="1" selected>USD/INR</option>
                    <option value="2">EUR/INR</option>
                    <option value="3">GBP/INR</option>
                  </select>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Spot Rate</label>
                  <input value=0 type="text" class="form-control" name="tspotRateAsk" id="tspotRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Spot</label>
                  <input value=0 type="text" class="form-control" name="tcashSpotAsk" id="tcashSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Cash Rate</label>
                  <input value=0 type="text" class="form-control" name="tcashRateAsk" id="tcashRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Spot</label>
                  <input value=0 type="text" class="form-control" name="ttomSpotAsk" id="ttomSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->

              <div class="col-md-2">
                <div class="form-group">
                  <label>Tom Rate</label>
                  <input value=0 type="text" class="form-control" name="ttomRateAsk" id="ttomRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div>
          <!-- /.box-body -->

        </div> <!-- /.tom-spot -->

      <?php
      }
      ?>

      <?php
      if ($allowFC != "YES") {
      ?>
        <div class="col-md-4 " style="margin-top: 10px;">
          <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

            <div class="box-body pad table-responsive" id="no-more-tables2" style="display: none;">

              <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed" id="t-bid-ask">
                <thead class="cf">
                  <tr>
                    <th class="numeric">
                      <h4><b>Quote Currency</b></h4>
                    </th>
                    <th colspan="2" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;" />
                      <h4 style="display:inline;"><b> INR (&#8377;)</b></h4>
                      </h4>
                    </th>
                  </tr>
                  <tr>
                    <th class="numeric">
                      <h4><b>Base Currency</b></h4>
                    </th>
                    <th class="numeric">
                      <h4><b>BID (&#8377;)</b> (to be referred by Exporters/Sellers) </h4>
                    </th>

                    <th class="numeric">
                      <h4><b>ASK (&#8377;)</b> (to be referred by Importers/Buyers) </h4>
                    </th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;" /> 1 USD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToUSDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToUSDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;" /> 1 EUR (&#8364;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToEURbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToEURask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;" /> 1 GBP (&#163;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToGBPbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToGBPask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;" /> 1 AUD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToAUDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToAUDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;" /> 1 CAD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToCADbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToCADask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;" /> 1 NZD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToNZDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToNZDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;" /> 1 AED (&#1583;.&#1573;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToAEDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToAEDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;" /> 1 SGD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToSGDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToSGDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;" /> 1 THB (&#3647;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToTHBbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToTHBask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/CNY.png" style="display: inline; width: 30px; height: auto;" /> 1 CNY (&#20803;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToCNYbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToCNYask"></td>
                  </tr>
                <tbody>

              </table>

            </div><!-- /.box -->

          </div>
        </div><!-- /.col -->
      <?php
      } else {
      ?>

        
      <?php
      }
      ?>

      <?php
      if ($allowFC != "YES") {
      ?>



      <?php
      } else {
        #if(isset($_SESSION['sessCustomerID'])){
        #  if($_SESSION['sessCustomerID'] == "7"){
      ?>
        <div class="container">
          <div class="row">
            
            <div class="col-md-6" style="margin-top: 50px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Export/Sell Forward Contract</b>
                  </p>
                </div>

                <div class="box-body" align=center>
                  <div id="d2b" class="converter-wrapper">
                    <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" id="tfwdbid">

                      <tbody>
                        <tr>
                          <td class="">
                            <h4><b>Currency Pair</b></h4>
                          </td>

                          <td class="" style="text-align: center;">
                            <b>
                              <select onchange="CalSpotFwdBidSample(document.form_EFD);" id="pairSelExp" class="form-control select2" style="font-size: 16px; text-align-last: center; width: 100%;">
                                <option selected="selected" value="1"><b>USD/INR</b></option>
                                <option value="2"><b>EUR/INR</b></option>
                                <option value="3"><b>GBP/INR</b></option>
                              </select>
                            </b>
                          </td>
                        </tr>

                        <tr>
                          <td class="">
                            <h4><b>Select Date</b></h4>
                          </td>

                          <td class="">
                            <form name="form_EFD" onSubmit="return false">
                              <input readonly placeholder="Select Date" required="required" type="text" name="dateExp" id="dateExp" onchange="CalSpotFwdBidSample(document.form_EFD);" style="cursor: pointer; font-size: 16px; background-color: #fff;">
                            </form>
                          </td>
                        </tr>

                        <tr>
                          <td class="">
                            <h4><b>Premium</b></h4>
                          </td>

                          <td class="">
                            <input value=0 type="text" class="" name="fwdPremBid" id="fwdPremBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                          </td>
                        </tr>

                        <tr>
                          <td class="">
                            <h4><b>Forward Rate (INR)</b></h4>
                          </td>

                          <td class="">
                            <form name="form_EFR" onSubmit="return false">
                              <input value=0 type="text" class="" name="fwdExp" id="fwdExp" readonly style="font-size: 16px; background-color: #e6eff3;">
                            </form>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6" style="margin-top: 50px;">
              <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="box-header" align=center>
                  <i class="fa fa-calculator"></i>
                  <p class="box-title" style="font-size: 22px;"><b>Import/Buy Forward Contract</b>
                  </p>
                </div>

                <div class="box-body" align=center>
                  <div id="d2c" class="converter-wrapper">
                    <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" id="tfwdask">

                      <tbody>
                        <tr>
                          <td class="">
                            <h4><b>Currency Pair</b></h4>
                          </td>

                          <td class="" style="text-align: center;">
                            <b>
                              <select onchange="CalSpotFwdAskSample(document.form_IFD);" id="pairSelImp" class="form-control select2" style="font-size: 16px; text-align-last: center; width: 100%;">
                                <option selected="selected" value="1"><b>USD/INR</b></option>
                                <option value="2"><b>EUR/INR</b></option>
                                <option value="3"><b>GBP/INR</b></option>
                              </select>
                            </b>

                          </td>
                        </tr>

                        <tr>
                          <td class="">
                            <h4><b>Select Date</b></h4>
                          </td>

                          <td class="">
                            <form name="form_IFD" onSubmit="return false">
                              <input readonly placeholder="Select Date" required="required" type="text" name="dateImp" id="dateImp" onchange="CalSpotFwdAskSample(document.form_IFD);" style="cursor: pointer; font-size: 16px; background-color: #fff;">
                            </form>
                          </td>
                        </tr>

                        <tr>
                          <td class="">
                            <h4><b>Premium </b></h4>
                          </td>

                          <td class="">
                            <input value=0 type="text" class="" name="fwdPremAsk" id="fwdPremAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                          </td>
                        </tr>

                        <tr>
                          <td class="">
                            <h4><b>Forward Rate (INR)</b></h4>
                          </td>

                          <td class="">
                            <form name="form_IFR" onSubmit="return false">
                              <input value=0 type="text" class="" name="fwdImp" id="fwdImp" readonly style="font-size: 16px; background-color: #e6eff3;">
                            </form>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
          <div class="col-md-12 " style="margin-top: 20px;">
          <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">
            <div class="box-header" align=center>
              <i class="fa fa-money"></i>
              <p class="box-title" style="font-size: 22px;"><b>Live Currency Rates &ndash; Bid and Ask</p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="box-body pad table-responsive" id="no-more-tables2">

              <table class="table table-bordered text-center table-bordered table-striped table-condensed cf" style="table-layout: fixed" id="t-bid-ask">
                <thead class="cf">
                  <tr>
                    <th class="numeric">
                      <h4><b>Quote Currency</b></h4>
                    </th>
                    <th colspan="2" class="numeric"><img src="images/flags/INR.png" style="display: inline; width: 40px; height: auto;" />
                      <h4 style="display:inline;"><b> INR (&#8377;)</b></h4>
                      </h4>
                    </th>
                  </tr>
                  <tr>
                    <th class="numeric">
                      <h4><b>Base Currency</b></h4>
                    </th>
                    <th class="numeric">
                      <h4><b>BID (&#8377;)</b> (to be referred by Exporters/Sellers) </h4>
                    </th>

                    <th class="numeric">
                      <h4><b>ASK (&#8377;)</b> (to be referred by Importers/Buyers) </h4>
                    </th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;" /> 1 USD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToUSDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToUSDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;" /> 1 EUR (&#8364;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToEURbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToEURask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;" /> 1 GBP (&#163;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToGBPbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToGBPask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;" /> 1 AUD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToAUDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToAUDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;" /> 1 CAD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToCADbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToCADask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;" /> 1 NZD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToNZDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToNZDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;" /> 1 AED (&#1583;.&#1573;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToAEDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToAEDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;" /> 1 SGD (&#36;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToSGDbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToSGDask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;" /> 1 THB (&#3647;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToTHBbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToTHBask"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <h4><b><img src="images/flags/CNY.png" style="display: inline; width: 30px; height: auto;" /> 1 CNY (&#20803;)</b></h4>
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToCNYbid"></td>

                    <td data-title="ASK (&#8377;)" id="inrToCNYask"></td>
                  </tr>
                <tbody>

              </table>
              <br />
              <br />
              <br />
            </div><!-- /.box -->

          </div>
        </div><!-- /.col -->
          </div>
        </div>
      <?php
        #}
        #}
      }
      ?>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>GST on Currency Conversion</b></h4>
            </div>
            <div class="modal-body">
              <table class="table table-bordered text-center table-bordered table-striped table-condensed cf">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <?php
      if (0) {
      ?>
        <div class="col-md-6">
          <div class="box box-solid" style="text-align: center;">

            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                </ol>
                <div class="carousel-inner" align=center>
                  <div class="item active">
                    <img src="images/slide01.png" alt="First slide">
                    <div class="carousel-caption">
                      <!-- First Slide -->
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slide02.png" alt="Second slide">
                    <div class="carousel-caption">
                      <!-- Second Slide -->
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slide03.png" alt="Third slide">
                    <div class="carousel-caption">
                      <!-- Third Slide -->
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slide04.png" alt="Fourth slide">
                    <div class="carousel-caption">
                      <!-- Fourth Slide -->
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      <?php
      }
      ?>

      <div class="col-md-12" style="margin-top: 10px; display: none;">

        <div class="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

          <!-- /.box-header -->

          <?php
          if ($allowFC != "YES") {
          ?>

            <div style="display: none;" class="box-body table-responsive">
              <table id="forecast" class="table table-bordered text-center table-bordered table-condensed cf" style="border-color: #D5D8DC;" border=1>
                <thead style="background-color: #EAEDED;">
                  <?php
                  $servername = "localhost";
                  $username = "ibrlive";
                  $password = "tubelight";
                  $dbname = "ibrMock";

                  //Create connection
                  $conn = OpenCon();
                  //$conn = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
                  $query = "SELECT pair, rate, c1, c2, c3, c4, updatedOn FROM forecasthead WHERE id=1";

                  $result = $conn->query($query);
                  ?>

                  <?php

                  while ($r2 = $result->fetch_assoc()) {

                  ?>
                    <tr>
                      <th class="numeric" colspan=6>Updated on: <font style="color: blue;"><?php echo $r2['updatedOn'] ?> </font>
                      </th>
                    </tr>
                    <tr>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['pair'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['rate'] ?> </b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c1'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c2'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c3'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c4'] ?></b></h4>
                      </th>
                    </tr>
                  <?php } ?>

                </thead>
                <tbody>
                  <?php
                  $query = "SELECT pair, rate, c1, c2, c3, c4 FROM forecast";

                  $result = $conn->query($query);
                  $cforecast = 0;
                  while ($r3 = $result->fetch_assoc()) {
                    $cforecast++;
                  ?>
                    <tr>
                      <td class="numeric"><?php echo $r3['pair'] ?></td>
                      <?php echo "<td class='numeric'><b><input class='no-border' id='frate-" . $cforecast . "' name='frate-" . $cforecast . "' readonly style='text-align: center;'></b></td>"; ?>
                      <td class="numeric"><?php echo $r3['c1'] ?></td>
                      <td class="numeric"><?php echo $r3['c2'] ?></td>
                      <td class="numeric"><?php echo $r3['c3'] ?></td>
                      <td class="numeric"><?php echo $r3['c4'] ?></td>
                    </tr>
                  <?php
                  }
                  $conn->close();
                  ?>

                </tbody>
              </table>
              <p><b>Disclaimer:</b> Currency forecasts are based on technical and fundamental analysis and taken from some trusted sources. IBR Live does not make its on forecasts. Forecasts may change frequently based on present facts and future events and may differ from actual prices. One should not fully rely on the above forecasts while making any financial decision. IBR live takes no responsibility on making any financial decisions based on the above forecasts.</p>
            </div>
          <?php
          } else {
          ?>
            <div class="box-header with-border" align=center>

              <i class="fa fa-line-chart"></i>
              <p class="box-title" style="font-size: 22px;"><b>Currency Forecasts </p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="box-body table-responsive">
              <table id="forecast" class="table table-bordered text-center table-bordered table-condensed cf" style="border-color: #D5D8DC;" border=1>
                <thead style="background-color: #EAEDED;">
                  <?php
                  $servername = "localhost";
                  $username = "ibrlive";
                  $password = "tubelight";
                  $dbname = "ibrMock";

                  //Create connection
                  $conn = OpenCon();
                  //$conn = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
                  $query = "SELECT pair, rate, c1, c2, c3, c4, updatedOn FROM forecasthead WHERE id=1";

                  $result = $conn->query($query);
                  ?>

                  <?php

                  while ($r2 = $result->fetch_assoc()) {

                  ?>
                    <tr>
                      <th class="numeric" colspan=6>Updated on: <font style="color: blue;"><?php echo $r2['updatedOn'] ?> </font>
                      </th>
                    </tr>
                    <tr>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['pair'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['rate'] ?> </b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c1'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c2'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c3'] ?></b></h4>
                      </th>
                      <th class="numeric" style="color: #21618C">
                        <h4><b><?php echo $r2['c4'] ?></b></h4>
                      </th>
                    </tr>
                  <?php } ?>

                </thead>
                <tbody>
                  <?php
                  $query = "SELECT pair, rate, c1, c2, c3, c4 FROM forecast";

                  $result = $conn->query($query);
                  $cforecast = 0;
                  while ($r3 = $result->fetch_assoc()) {
                    $cforecast++;
                  ?>
                    <tr>
                      <td class="numeric"><?php echo $r3['pair'] ?></td>
                      <?php echo "<td class='numeric'><b><input class='no-border' id='frate-" . $cforecast . "' name='frate-" . $cforecast . "' readonly style='text-align: center;'></b></td>"; ?>
                      <td class="numeric"><?php echo $r3['c1'] ?></td>
                      <td class="numeric"><?php echo $r3['c2'] ?></td>
                      <td class="numeric"><?php echo $r3['c3'] ?></td>
                      <td class="numeric"><?php echo $r3['c4'] ?></td>
                    </tr>
                  <?php
                  }
                  $conn->close();
                  ?>

                </tbody>
              </table>
              <p><b>Disclaimer:</b> Currency forecasts are based on technical and fundamental analysis and taken from some trusted sources. IBR Live does not make its on forecasts. Forecasts may change frequently based on present facts and future events and may differ from actual prices. One should not fully rely on the above forecasts while making any financial decision. IBR live takes no responsibility on making any financial decisions based on the above forecasts.</p>
            </div>
          <?php
          }
          ?>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->

      </div>

      <?php
      #if(isset($_SESSION['sessCustomerID'])){
      #  if($_SESSION['sessCustomerID'] == "7"){
      ?>



      <div class="col-md-12" style="margin-top: 50px;">

        <div>

          <!-- /.box-header -->

          <?php
          if ($allowFC != "YES") { ?>

            <div class="box-body" style="display: none;">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Select Pair</label>
                    <select id="pairSel" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="1">USD/INR</option>
                      <option value="2">EUR/INR</option>
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Select Date Range</label>
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                      <input id="startTimestamp" style="display: none;" />
                      <input id="endTimestamp" style="display: none;" />
                    </div>
                  </div>
                  <!-- /.form-group -->

                </div>
                <!-- /.col -->

                <div class="col-md-2">
                  <div class="form-group">
                    <label>Submit Query</label>
                    <button class="form-control btn btn-primary" onclick="findHistData()">Submit</button>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <table id="hist-data" class="table text-center table-condensed" style="table-layout: fixed; border-color: #D5D8DC; display: none;" border=1>
                <thead class="cf" style="background-color: #EAEDED;">
                  <tr>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Date</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Open (&#8377;)</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>High (&#8377;)</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Low (&#8377;)</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Close (&#8377;)</b></h4>
                    </th>
                  </tr>
                </thead>

              </table>

            </div>
            <!-- /.box-body -->
          <?php
          } else {
          ?>
            <div class="box-header with-border" align=center>
              <i class="fa fa-money"></i>
              <p class="box-title" style="font-size: 22px;"><b>Monthly Forward Rates </p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-12 box-body table-responsive">
                  <table class="table text-center ">
                    <thead>
                      <tr>
                        <th rowspan="2" style="width:auto;"><select class="form-control select2" id="monthcurrency">
                            <option selected value="1">USD/INR</option>
                            <option value="2">EUR/INR</option>
                            <option value="3">GBP/INR</option>
                          </select>
                        </th>
                        <th>Spot Bid</th>
                        <th>Spot Ask</th>
                        <th colspan="4"></th>
                      </tr>
                      <tr>
                        <th id="spotbidmonth"></th>
                        <th id="askbidmonth"></th>
                        <th colspan="4"></th>
                      </tr>

                      <tr>
                        <th>Month</th>
                        <th>Bid</th>
                        <th>Ask</th>
                        <th>Final Rate Bid</th>
                        <th>Final Rate Ask</th>
                        <th>Yield Bid</th>
                        <th>Yield Ask</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //Create connection
                      $conn = OpenCon();
                      //$conn = new mysqli($servername, $username, $password, $dbname);

                      // Check connection
                      if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                      }

                      $custId = $_SESSION['sessCustomerID'];

                      $query = "SELECT id, month, settleDate, bidPrem, askPrem, bidPremEUR, askPremEUR, bidPremGBP, askPremGBP FROM usdFwdRate";
                      $result2 = $conn->query($query);

                      $pname = "";
                      $m = 0;

                      ?>

                      <?php
                      $d = 0;
                      while ($row2 = $result2->fetch_assoc()) {
                        $end = new DateTime($arrDay[$m + 1]);
                        $start = new DateTime($arrDay[$m]);

                        $dif = $end->diff($start);
                        $dif = intval($dif->d) + 1;
                        $dbid = $row2['bidPrem'];
                        $dask = $row2['askPrem'];
                        $monthh = $row2['month'];
                        $dbide = $row2['bidPremEUR'];
                        $daske = $row2['askPremEUR'];
                        $dbidg = $row2['bidPremGBP'];
                        $daskg = $row2['askPremGBP'];





                        $d++;
                        echo "<tr>
                  <td>$monthh</td>
                  
                 
                  
                  <td  class='spotbidme'>$dbid</td>
                  
                  <td class='spotaskme'>$dask</td>
                  <td  class='spotbidmee'>$dbide</td>
                  
                  <td class='spotaskmee'>$daske</td>
                  <td  class='spotbidmeg'>$dbidg</td>
                  
                  <td class='spotaskmeg'>$daskg</td>
                  
                  <td class='FinalBid'></td>
                  <td class='FinalAsk'></td>
                  <td class='YieldBid'></td>
                  <td class='YieldAsk'></td>
                 </tr>
                 
                 ";

                        $m++;
                      }
                      ?>

                    </tbody>

                  </table>
                </div>
              </div>
            </div>


            <div class="box-header with-border" align=center>
              <i class="fa fa-money"></i>
              <p class="box-title" style="font-size: 22px;"><b>Historical Data </p>
              <font style="font-size: 16px;"></b></font>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Select Pair</label>
                    <select id="pairSel" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="1">USD/INR</option>
                      <option value="2">EUR/INR</option>
                    </select>
                  </div>
                  <!-- /.form-group -->

                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Select Date Range</label>
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                      <input id="startTimestamp" style="display: none;" />
                      <input id="endTimestamp" style="display: none;" />
                    </div>
                  </div>
                  <!-- /.form-group -->

                </div>
                <!-- /.col -->

                <div class="col-md-2">
                  <div class="form-group">
                    <label>Submit Query</label>
                    <button class="form-control btn btn-primary" onclick="findHistData()">Submit</button>
                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <table id="hist-data" class="table text-center table-condensed" style="table-layout: fixed; border-color: #D5D8DC; display: none;" border=1>
                <thead class="cf" style="background-color: #EAEDED;">
                  <tr>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Date</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Open (&#8377;)</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>High (&#8377;)</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Low (&#8377;)</b></h4>
                    </th>
                    <th class="numeric" style="color: #21618C">
                      <h4><b>Close (&#8377;)</b></h4>
                    </th>
                  </tr>
                </thead>

              </table>

            </div>
            <!-- /.box-body -->
          <?php
          }
          ?>
        </div>
        <!-- /.box -->



      </div>


      <?php
      #}
      #}
      ?>


    </div>
    </div>

    </section>
    </div>
    </div>

    <?php include_once("include/footer.php"); ?>
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
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <script src="bower_components/jquery-ui/jquery-ui.js"></script>
    <script>
      var holidayArr = <?php echo json_encode($listHoliday); ?>;
      var holidayArr_ = [];
      for (var key in holidayArr) {
        holidayArr_.push(key);
      }

      function DisableDates(date) {
        var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
        return [holidayArr_.indexOf(string) == -1];
      }



      $(function() {
        var minD = <?php echo json_encode($minDay); ?>;
        var maxD = <?php echo json_encode($maxDay); ?>;

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

      var op = <?PHP echo (!empty($user) ? json_encode($user) : '""'); ?>;
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
            document.getElementById('tcashSpotBid').value = <?php echo $cashBidUsd; ?>;
            document.getElementById('tcashRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
            document.getElementById('ttomSpotBid').value = <?php echo $tomBidUsd; ?>;
            document.getElementById('ttomRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
            break;

          case '2':
            bodyText = document.getElementById('inrToEURbid').innerHTML;
            bodyText = bodyText.replace(re, '');
            bid = parseFloat(bodyText);
            document.getElementById('tspotRateBid').value = bid.toFixed(4);
            document.getElementById('tcashSpotBid').value = <?php echo $cashBidEur; ?>;;
            document.getElementById('tcashRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
            document.getElementById('ttomSpotBid').value = <?php echo $tomBidEur; ?>;
            document.getElementById('ttomRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('ttomSpotBid').value).toFixed(4);
            break;

          case '3':
            bodyText = document.getElementById('inrToGBPbid').innerHTML;
            bodyText = bodyText.replace(re, '');
            bid = parseFloat(bodyText);
            document.getElementById('tspotRateBid').value = bid.toFixed(4);
            document.getElementById('tcashSpotBid').value = <?php echo $cashBidGbp; ?>;;
            document.getElementById('tcashRateBid').value = (document.getElementById('tspotRateBid').value - document.getElementById('tcashSpotBid').value).toFixed(4);
            document.getElementById('ttomSpotBid').value = <?php echo $tomBidGbp; ?>;
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


            document.getElementById('tcashSpotAsk').value = <?php echo $cashAskUsd; ?>;
            document.getElementById('tcashRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
            document.getElementById('ttomSpotAsk').value = <?php echo $tomAskUsd; ?>;
            document.getElementById('ttomRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
            break;

          case '2':
            bodyText = document.getElementById('inrToEURask').innerHTML;
            bodyText = bodyText.replace(re, '');
            ask = parseFloat(bodyText);
            document.getElementById('tspotRateAsk').value = ask.toFixed(4);
            document.getElementById('tcashSpotAsk').value = <?php echo $cashAskEur; ?>;;
            document.getElementById('tcashRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
            document.getElementById('ttomSpotAsk').value = <?php echo $tomAskEur; ?>;
            document.getElementById('ttomRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
            break;

          case '3':
            bodyText = document.getElementById('inrToGBPask').innerHTML;
            bodyText = bodyText.replace(re, '');
            ask = parseFloat(bodyText);
            document.getElementById('tspotRateAsk').value = ask.toFixed(4);
            document.getElementById('tcashSpotAsk').value = <?php echo $cashAskGbp; ?>;;
            document.getElementById('tcashRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('tcashSpotAsk').value).toFixed(4);
            document.getElementById('ttomSpotAsk').value = <?php echo $tomAskGbp; ?>;
            document.getElementById('ttomRateAsk').value = (document.getElementById('tspotRateAsk').value - document.getElementById('ttomSpotAsk').value).toFixed(4);
            break;
        }

      }
    </script>
  </body>

  </html>

<?php
}
?>
