<?php

include_once('lib/database.php');
if ($_SERVER['HTTPS'] != "on") {
  $url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  header("Location: $url");
  exit;
}

if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
error_reporting(E_ALL);

$servername = "localhost";
$username = "ibrlive";
$password = "tubelight";
$dbname = "ibrMock";
$succ = "";
$err = "";
$conn = OpenCon();
//$conn = new mysqli($servername, $username, $password, $dbname);
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
//die('here');
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

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Get Live Interbank Exchange Rate, USD INR Forward Rates, USD INR SPOT Rate, USD to INR Cash Rate, International Money Transfer, Live Currency Converter. Visit now!">
  <meta name="keywords" content="usd inr,usd to inr live,eur inr,dollar to inr,dollar to rupee,1 usd to inr,gbp to inr,aed to inr,usd to inr today,aud to inr,INETRBANK USD INR RATE,IBR RATE TODAY">

  <title>Home | IBR Live</title>



  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
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
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7973633976221713"
     crossorigin="anonymous"></script>
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
    <?php include_once('include/top-menu.php'); ?>
    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Your Forex Our Expertise</h4>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="owl-carousel-stacked owl-carousel">
              <div class="item">
              <a href="https://payment-forms-lrs.cashfree.com/ibr_live">
                <h5>Send Money Abroad</h5>
                <p>Send money to your Loved hassle-free in form of Gift, & Family Maintenance. Remit Education fees, GIC through Flywire, WUBS, CIBC & PayMyTuition
                  Lowest Rate Guaranteed</p>
              </a>
              </div>
              <div class="item">
              <a href="https://ibrlive.com/plans-and-pricing#lending_service">
                <h5>Lending Services</h5>
                <p>Get benefitted from RBI’s Interest equalisation Scheme. Avail Export credit limits at lowest interest rates. Lowest Buyer's credit quotes and all kind of foreign fundings.</p>
              </a>
              </div>
              <div class="item">
                <a href="https://ibrlive.com/plans-and-pricing#fxpress_standard">
                  <h5>Fxpress Standard (The Forex Portal)</h5>
                  <p>Authentic & Real time exchange rates with CASH TOM SPOT values, Forward premiums, Currency forecast, Historical rates and many more.</p>
                </a>
              </div>
              <div class="item">
                <a href="https://ibrlive.com/plans-and-pricing#scrip_sale">
                  <h5>Scrip Sale & Purchase</h5>
                  <p>Buying & Selling scrips made convenient, economical & transparent by bringing genuine buyers and sellers on same platform</p>
                </a>
              </div>
              <div class="item" style="height: 400px;">
                <a href="https://ibrlive.com/lei-code">
                  <h5>Legal Entity Identifier</h5>
                  <p>Get an LEI certificate issued or renewed at lowest price. Issuance within 24 hours.</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- live interbank exchange start -->
  <div class="container-fluid stathome-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-0">Live Interbank Exchange Rates</h1>
      </div>
      <div class="row g-5">
        <div class="col-lg-8">
          <div class="card blog-item">
            <div class="table-responsive">

              <table class="table table-striped table-borderless table-hover cf" style="table-layout: fixed">

                <tr style="--bs-table-accent-bg: transparent;">
                  <th colspan="2" class="numeric">Quote Currency</th>
                  <th colspan="2"><span class="flag-icon flag-icon-in flag-icon-squared"></span> INR (<i class="fas fa-rupee-sign"></i>)</th>
                </tr>

                <tr>
                  <th class="numeric">Base Currency</th>
                  <th class="numeric">LIVE RATES <small>(Mid Values) (<i class="fas fa-rupee-sign"></i>)</small></th>
                  <th class="numeric">HIGH (<i class="fas fa-rupee-sign"></i>)</th>
                  <th class="numeric">LOW (<i class="fas fa-rupee-sign"></i>)</th>
                </tr>

                <tr>
                  <td class="numeric">
                    <img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;" /> 1 USD (&#36;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToUSD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToUSDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToUSDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;" /> 1 EUR (&#8364;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToEUR"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToEURhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToEURlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;" /> 1 GBP (&#163;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToGBP"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToGBPhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToGBPlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;" /> 1 AUD (&#36;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToAUD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToAUDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToAUDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;" /> 1 CAD (&#36;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToCAD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToCADhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToCADlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;" /> 1 NZD (&#36;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToNZD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToNZDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToNZDlow"></td>
                </tr>

                <tr>
                  <td class="numeric">
                    <img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;" /> 1 AED (&#1583;.&#1573;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToAED"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToAEDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToAEDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;" /> 1 SGD (&#36;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToSGD"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToSGDhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToSGDlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;" /> 1 THB (&#3647;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToTHB"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToTHBhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToTHBlow"></td>
                </tr>
                <tr>
                  <td class="numeric">
                    <img src="images/flags/CNY.png" style="display: inline; width: 30px; height: auto;" /> 1 CNY (&#20803;)
                  </td>
                  <td data-title="RATE (&#8377;)" id="inrToCNY"></td>

                  <td data-title="HIGH (&#8377;)" id="inrToCNYhigh"></td>
                  <td data-title="LOW (&#8377;)" id="inrToCNYlow"></td>
                </tr>

              </table>
            </div>

          </div>
        </div>
        <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s">
          <div class="card blog-item">
            <div class="table-responsive">

              <table class="table table-striped table-borderless table-hover" cf" style="table-layout: fixed;">
                <tr style="--bs-table-accent-bg: transparent;">
                  <th colspan="2" class="text-center">Major Currency Pairs</th>
                </tr>
                <tr>
                  <th>Currency Pairs</th>
                  <th>LIVE RATES <small>(Mid Values)</small></th>
                </tr>
                <tbody>
                  <tr>
                    <td class="numeric">
                      <b> EUR/USD</b>
                    </td>
                    <td data-title="RATE" id="eurANDusd"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> GBP/USD</b>
                    </td>
                    <td data-title="RATE" id="gbpANDusd"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> AUD/USD</b>
                    </td>
                    <td data-title="RATE" id="audANDusd"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> NZD/USD</b>
                    </td>
                    <td data-title="RATE" id="nzdANDusd"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> EUR/GBP</b>
                    </td>
                    <td data-title="RATE" id="eurANDgbp"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> USD/JPY</b>
                    </td>
                    <td data-title="RATE" id="usdANDjpy"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> USD/CNY</b>
                    </td>
                    <td data-title="RATE" id="usdANDcny"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> USD/CHF</b>
                    </td>
                    <td data-title="RATE" id="usdANDchf"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> USD/CAD</b>
                    </td>
                    <td data-title="RATE" id="usdANDcad"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <b> USD/HKD</b>
                    </td>
                    <td data-title="RATE" id="usdANDhkd"></td>
                  </tr>
                <tbody>

              </table>

            </div>

          </div>

        </div>
        <div class="col-md-12" style="text-align: center;">
          <h5>
            <p><strong>Real Time Exchange Rates ( Mid Market Values)</strong><br><small>
                Real Time Exchange rates (Mid Market Rates/Interbank Rates/Spot rates)- Mid Market rates are average of buy &amp; sell transactional rates of a currency pair. <br>These rates are just for reference purpose and not for transaction purpose.</small></p>
          </h5>
        </div>
      </div>
    </div>
  </div>
  <!-- live interbank exchange end -->

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
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display:none;">
      <div class="container">
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
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display:none;">
      <div class="container">
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

  <!-- /.box-header -->

  <?php
  if ($allowFC != "YES") {
  ?>
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
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
                  <?php echo "<td class='numeric'><b><input class='no-border form-control' id='frate-" . $cforecast . "' name='frate-" . $cforecast . "' readonly style='text-align: center;'></b></td>"; ?>
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
      </div>
    </div>
  <?php
  } else {
  ?>
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display: none;">
      <div class="container">
        <div class="box-header with-border" align=center>

          <i class="fa fa-line-chart"></i>
          <h3>Currency Forecasts </h3>
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
                  <?php echo "<td class='numeric'><b><input class='no-border form-control' id='frate-" . $cforecast . "' name='frate-" . $cforecast . "' readonly style='text-align: center;'></b></td>"; ?>
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
      </div>
    </div>
  <?php
  }
  ?>
  <!-- /.box-body -->



  <!-- curency converter start -->

  <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-0">Currency Converter</h1>
      </div>
      <div class="row mb-3">
        <div class="col-lg-6 wow zoomIn" data-wow-delay="0.2s">
          <div class="card cur-con text-center">
            <div class="row mb-4">
              <div class="col-md-12 text-center">
                <h6 class="mb-4"><i class="fas fa-calculator"></i> Currency Converter <small>(Others to INR)</small></h6>
              </div>

              <div class="col-lg-5">
                <form name="form_E" onSubmit="return false">
                  <input type="text" class="form-control px-4 numbersonly" name="unit2_input" maxlength="10" value="0" onKeyUp="CalculateUnit2(document.form_E, document.form_F)">
                  <select class="form-select bg-blue" aria-label="Default select example" name="unit2_menu" onChange="CalculateUnit2(document.form_E, document.form_F)">
                    <option>USD</option>
                    <option>EUR</option>
                    <option>GBP</option>
                    <option>AUD</option>
                    <option>CAD</option>
                    <option>NZD</option>
                    <option>AED</option>
                    <option>SGD</option>
                    <option>THB</option>
                    <option>CNY</option>
                  </select>
                </form>
              </div>
              <div class="col-lg-2 text-center">
                <h1>=</h1>
              </div>
              <div class="col-lg-5">
                <form name="form_F" onSubmit="return false">
                  <input type="text" class="form-control px-4 numbersonly" name="unit2_input" maxlength="10" value="0" onkeyup="CalculateUnit(document.form_E, document.form_F)" readonly>
                  <select disabled class="form-select bg-blue" aria-label="Default select example" name="unit2_menu" onChange="CalculateUnit(document.form_E, document.form_F)">
                    <option>INR</option>
                  </select>
                </form>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12 text-center">
                <h6 class="mb-4"><i class="fas fa-calculator"></i> Currency Converter <small>(INR to Others)</small></h6>
              </div>
              <div class="col-lg-5">
                <form name="form_A" onSubmit="return false">
                  <input type="text" class="form-control px-4 numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateUnit(document.form_A, document.form_B)">
                  <select class="form-select bg-blue" aria-label="Default select example">
                    <option selected>INR</option>
                  </select>
                </form>
              </div>
              <div class="col-lg-2 text-center">
                <h1>=</h1>
              </div>
              <div class="col-lg-5">
                <form name="form_B" onSubmit="return false">
                  <input type="text" class="form-control px-4 numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateUnit(document.form_A, document.form_B)" readonly>
                  <select class="form-select bg-blue" aria-label="Default select example" name="unit_menu" onchange="CalculateUnit(document.form_A, document.form_B)">
                    <option>USD</option>
                    <option>EUR</option>
                    <option>GBP</option>
                    <option>AUD</option>
                    <option>CAD</option>
                    <option>NZD</option>
                    <option>AED</option>
                    <option>SGD</option>
                    <option>THB</option>
                    <option>CNY</option>
                  </select>
                </form>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-6 wow zoomIn" data-wow-delay="0.4s">
          <div class="card cur-con text-center">
            <div class="row mb-4">
              <div class="col-md-12 text-center">
                <h6 class="mb-4"><i class="fas fa-calculator"></i> GST on Currency Convertion <small><a href="#" data-toggle="modal" data-target="#modal-default"><i class="fas fa-question-circle"></i></a></small></h6>
              </div>


              <div class="col-lg-6 text-center">
                <label>Amount (Foreign Currency)</label>
              </div>
              <div class="col-lg-6">
                <form name="form_I" onSubmit="return false">
                  <input value=0 type="text" class="form-control px-4 mb-4 numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateGST(document.form_I, document.form_J, document.form_K)" style="font-size: 16px; background-color: #fff;">
                </form>
              </div>
              <div class="col-lg-6 text-center">
                <label>Rate (INR)</label>
              </div>
              <div class="col-lg-6">
                <form name="form_J" onSubmit="return false">
                  <input value=0 type="text" class="form-control px-4 mb-4 numbersonly" name="unit_input" maxlength="10" value="0" onkeyup="CalculateGST(document.form_I, document.form_J, document.form_K)" style="font-size: 16px; background-color: #fff;">
                </form>
              </div>
              <div class="col-lg-6 text-center">
                <label>GST Payable (INR)</label>
              </div>
              <div class="col-lg-6">
                <form name="form_K" onSubmit="return false">
                  <input value=0 type="text" class="form-control px-4 mb-4 numbersonly" name="unit_input" readonly style="font-size: 16px; background-color: #e6eff3;">
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- curency converter end -->

  <!--  Cash Tom Spot Rate start-->

  <?php
  if ($allowFC != "YES") {
  ?>

    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display: none;">
      <div class="container">
        <div class="box-header with-border" align=center>

          <i class="fa fa-money"></i>
          <h3>Cash Tom Spot Rate</h3>
          <font style="font-size: 16px;"></b></font>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Currency Pair (Bid)</label>
                <select id="pairSelTomBid" onclick="findTomSpotBidData(this.value)" class="form-control select2 px-4" style="width: 100%;">

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
                <input value=0 type="text" class="form-control px-4" name="tspotRateBid" id="tspotRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control px-4" name="tcashSpotBid" id="tcashSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control px-4" name="tcashRateBid" id="tcashRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control px-4" name="ttomSpotBid" id="ttomSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control px-4" name="ttomRateBid" id="ttomRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
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
                <select id="pairSelTomAsk" onclick="findTomSpotAskData(this.value)" class="form-control select2 px-4" style="width: 100%;">
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
                <input value=0 type="text" class="form-control px-4" name="tspotRateAsk" id="tspotRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control px-4" name="tcashSpotAsk" id="tcashSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control px-4" name="tcashRateAsk" id="tcashRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control px-4" name="ttomSpotAsk" id="ttomSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control px-4" name="ttomRateAsk" id="ttomRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </div> <!-- /.tom-spot -->
  <?php
  } else {
  ?>

    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display: none;">
      <div class="container">


        <div class="box-header with-border" align=center>

          <i class="fa fa-money"></i>
          <h3>Cash Tom Spot Rate</h3>
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
                <input value=0 type="text" class="form-control px-4" name="tspotRateBid" id="tspotRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control px-4" name="tcashSpotBid" id="tcashSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control px-4" name="tcashRateBid" id="tcashRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control px-4" name="ttomSpotBid" id="ttomSpotBid" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control px-4" name="ttomRateBid" id="ttomRateBid" readonly style="font-size: 16px; background-color: #e6eff3;">
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
                <select id="pairSelTomAsk" onclick="findTomSpotAskData(this.value)" class="form-control px-4 select2" style="width: 100%;">
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
                <input value=0 type="text" class="form-control px-4" name="tspotRateAsk" id="tspotRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Spot</label>
                <input value=0 type="text" class="form-control px-4" name="tcashSpotAsk" id="tcashSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Cash Rate</label>
                <input value=0 type="text" class="form-control px-4" name="tcashRateAsk" id="tcashRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Spot</label>
                <input value=0 type="text" class="form-control px-4" name="ttomSpotAsk" id="ttomSpotAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-2">
              <div class="form-group">
                <label>Tom Rate</label>
                <input value=0 type="text" class="form-control px-4" name="ttomRateAsk" id="ttomRateAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </div> <!-- /.tom-spot -->

  <?php
  }
  ?>

  <!--  Cash Tom Spot Rate end-->


  <!--  Live Currency Rates – Bid and Ask start-->
  <?php
  if ($allowFC != "YES") {
  ?>
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display: none;">
      <div class="container">
        <div class="box-header" align=center>
          <i class="fa fa-money"></i>
          <h4><b>Live Currency Rates &ndash; Bid and Ask</h4>
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
                  <b>Base Currency</b>
                </th>
                <th class="numeric">
                  <b>BID (&#8377;)</b> (to be referred by Exporters/Sellers)
                </th>

                <th class="numeric">
                  <b>ASK (&#8377;)</b> (to be referred by Importers/Buyers)
                </th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td class="numeric">
                  <img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;" /> 1 USD (&#36;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToUSDbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToUSDask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;" /> 1 EUR (&#8364;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToEURbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToEURask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;" /> 1 GBP (&#163;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToGBPbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToGBPask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;" /> 1 AUD (&#36;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToAUDbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToAUDask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;" /> 1 CAD (&#36;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToCADbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToCADask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;" /> 1 NZD (&#36;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToNZDbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToNZDask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;" /> 1 AED (&#1583;.&#1573;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToAEDbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToAEDask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;" /> 1 SGD (&#36;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToSGDbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToSGDask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;" /> 1 THB (&#3647;)
                </td>
                <td data-title="BID (&#8377;)" id="inrToTHBbid"></td>

                <td data-title="ASK (&#8377;)" id="inrToTHBask"></td>
              </tr>
              <tr>
                <td class="numeric">
                  <img src="images/flags/CNY.png" style="display: inline; width: 30px; height: auto;" /> 1 CNY (&#20803;)
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
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display: none;">
      <div class="container">
        <div class="box-header" align=center>
          <i class="fa fa-money"></i>
          <h4><b>Live Currency Rates &ndash; Bid and Ask</h4>
          <font style="font-size: 16px;"></b></font>
        </div>


        <div class="row g-5">
          <div class="col-lg-8">
            <div class="card blog-item">
              <div class="table-responsive" id="no-more-tables2">
                <table class="table table-striped table-borderless table-hover cf" id="t-bid-ask">
                  <tr style="--bs-table-accent-bg: transparent;">
                    <th colspan="2">Quote Currency</th>
                    <th colspan="2"><span class="flag-icon flag-icon-in flag-icon-squared"></span> INR (<i class="fas fa-rupee-sign"></i>)</th>
                  </tr>
                  <tr>
                    <th class="numeric">
                      <b>Base Currency</b>
                    </th>
                    <th class="numeric">
                      <b>BID (&#8377;)</b> (to be referred by Exporters/Sellers)
                    </th>

                    <th class="numeric">
                      <b>ASK (&#8377;)</b> (to be referred by Importers/Buyers)
                    </th>
                  </tr>
                  <!-- <tr>
                      <th>Base Currency</th>
                      <th>LIVE RATES <small>(Mid Values) (<i class="fas fa-rupee-sign"></i>)</small></th>
                      <th>HIGH (<i class="fas fa-rupee-sign"></i>)</th>
                      <th>LOW (<i class="fas fa-rupee-sign"></i>)</th>
                    </tr> -->


                  <tr>
                    <td><img src="images/flags/USD.png" style="display: inline; width: 30px; height: auto;" /> 1 USD (&#36;)</td>
                    <td data-title="BID (&#8377;)" id="inrToUSDbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToUSDask" style="text-align: center;"></td>
                  </tr>
                  <!-- <tr>
                      <td><span class="flag-icon flag-icon-fi flag-icon-squared"></span> 1 EUR (<i class="fas fa-euro-sign"></i>)</td>
                      <td>87.6682</td>
                      <td>877188</td>
                      <td>87.3863</td>
                    </tr> -->
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/EUR.png" style="display: inline; width: 30px; height: auto;" /> 1 EUR (&#8364;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToEURbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToEURask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/GBP.png" style="display: inline; width: 30px; height: auto;" /> 1 GBP (&#163;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToGBPbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToGBPask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/AUD.png" style="display: inline; width: 30px; height: auto;" /> 1 AUD (&#36;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToAUDbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToAUDask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/CAD.png" style="display: inline; width: 30px; height: auto;" /> 1 CAD (&#36;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToCADbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToCADask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/NZD.png" style="display: inline; width: 30px; height: auto;" /> 1 NZD (&#36;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToNZDbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToNZDask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/AED.png" style="display: inline; width: 30px; height: auto;" /> 1 AED (&#1583;.&#1573;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToAEDbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToAEDask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/SGD.png" style="display: inline; width: 30px; height: auto;" /> 1 SGD (&#36;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToSGDbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToSGDask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/THB.png" style="display: inline; width: 30px; height: auto;" /> 1 THB (&#3647;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToTHBbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToTHBask" style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td class="numeric">
                      <img src="images/flags/CNY.png" style="display: inline; width: 30px; height: auto;" /> 1 CNY (&#20803;)
                    </td>
                    <td data-title="BID (&#8377;)" id="inrToCNYbid" style="text-align: center;"></td>

                    <td data-title="ASK (&#8377;)" id="inrToCNYask" style="text-align: center;"></td>
                  </tr>
                </table>
              </div>

            </div>
          </div>
          <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s">
            <div class="card blog-item">
              <div class="table-responsive">
                <table class="table table-striped table-borderless table-hover cf" id="tfwdbid">
                  <tr style="--bs-table-accent-bg: transparent;">
                    <th colspan="2" class="text-center"><b>Export/Sell Forward Contract</b></th>
                  </tr>
                  <!-- <tr>
                      <td>EUR/USD</td>
                      <td>82.5940</td>
                    </tr>
                    <tr>
                      <td>GBP/EUR</td>
                      <td>87.6682</td>
                    </tr> -->

                  <tbody>
                    <tr>
                      <td class="">
                        <b>Currency Pair</b>
                      </td>

                      <td class="" style="text-align: center;">
                        <b>
                          <select onchange="CalSpotFwdBidSample(document.form_EFD);" id="pairSelExp" class="form-control px-4 select2" style="font-size: 16px; text-align-last: center; width: 100%;">
                            <option selected="selected" value="1"><b>USD/INR</b></option>
                            <option value="2"><b>EUR/INR</b></option>
                            <option value="3"><b>GBP/INR</b></option>
                          </select>
                        </b>
                      </td>
                    </tr>

                    <tr>
                      <td class="">
                        <b>Select Date</b>
                      </td>

                      <td class="">
                        <form name="form_EFD" onSubmit="return false">
                          <input readonly placeholder="Select Date" required="required" type="text" name="dateExp" id="dateExp" onchange="CalSpotFwdBidSample(document.form_EFD);" class="form-control px-4" style="cursor: pointer; font-size: 16px; background-color: #fff;">
                        </form>
                      </td>
                    </tr>

                    <tr>
                      <td class="">
                        <b>Premium</b>
                      </td>

                      <td class="">
                        <input value=0 type="text" class="form-control px-4" name="fwdPremBid" id="fwdPremBid" readonly style="font-size: 16px; background-color: #e6eff3;">
                      </td>
                    </tr>

                    <tr>
                      <td class="">
                        <b>Forward Rate (INR)</b>
                      </td>

                      <td class="">
                        <form name="form_EFR" onSubmit="return false">
                          <input value=0 type="text" class="form-control px-4" name="fwdExp" id="fwdExp" readonly style="font-size: 16px; background-color: #e6eff3;">
                        </form>
                      </td>
                    </tr>
                  </tbody>

                </table>
              </div>

            </div>
            <br />
            <div class="card blog-item">
              <div class="table-responsive">
                <table class="table table-striped table-borderless table-hover cf" id="tfwdask">
                  <tr style="--bs-table-accent-bg: transparent;">
                    <th colspan="2" class="text-center"><b>Import/Buy Forward Contract</b></th>
                  </tr>
                  <tbody>
                    <tr>
                      <td class="">
                        <b>Currency Pair</b>
                      </td>

                      <td class="" style="text-align: center;">
                        <b>
                          <select onchange="CalSpotFwdAskSample(document.form_IFD);" id="pairSelImp" class="form-control px-4 select2" style="font-size: 16px; text-align-last: center; width: 100%;">
                            <option selected="selected" value="1"><b>USD/INR</b></option>
                            <option value="2"><b>EUR/INR</b></option>
                            <option value="3"><b>GBP/INR</b></option>
                          </select>
                        </b>

                      </td>
                    </tr>

                    <tr>
                      <td class="">
                        <b>Select Date</b>
                      </td>

                      <td class="">
                        <form name="form_IFD" onSubmit="return false">
                          <input readonly placeholder="Select Date" class="form-control px-4" required="required" type="text" name="dateImp" id="dateImp" onchange="CalSpotFwdAskSample(document.form_IFD);" style="cursor: pointer; font-size: 16px; background-color: #fff;">
                        </form>
                      </td>
                    </tr>

                    <tr>
                      <td class="">
                        <b>Premium </b>
                      </td>

                      <td class="">
                        <input value=0 type="text" class="form-control px-4" name="fwdPremAsk" id="fwdPremAsk" readonly style="font-size: 16px; background-color: #e6eff3;">
                      </td>
                    </tr>

                    <tr>
                      <td class="">
                        <b>Forward Rate (INR)</b>
                      </td>

                      <td class="">
                        <form name="form_IFR" onSubmit="return false">
                          <input value=0 type="text" class="form-control px-4" name="fwdImp" id="fwdImp" readonly style="font-size: 16px; background-color: #e6eff3;">
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>

          </div>

          <!-- <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s">
              <div class="card blog-item">
                <div class="table-responsive">
                  <table class="table table-striped table-borderless table-hover">
                    <tr style="--bs-table-accent-bg: transparent;">
                      <th colspan="2" class="text-center">Major Currency Pairs</th>
                    </tr>
                    <tr>
                      <th>Currency Pairs</th>
                      <th>LIVE RATES <small>(Mid Values)</small></th>
                    </tr>
                    <tr>
                      <td>EUR/USD</td>
                      <td>82.5940</td>
                    </tr>
                    <tr>
                      <td>GBP/EUR</td>
                      <td>87.6682</td>
                    </tr>

                  </table>
                </div>

              </div>

            </div> -->
        </div>

      </div>
    </div><!-- /.col -->
  <?php
  }
  ?>

  <!--  Live Currency Rates – Bid and Ask end-->

  <!-- Historical data start -->
  <?php
  if ($allowFC != "YES") { ?>
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s">
      <div class="container">
        <div class="box-body" style="display: none;">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Select Pair</label>
                <select id="pairSel" class="form-control px-4 select2 select2" style="width: 100%;">
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
                <div id="reportrange" class="form-control px-4 select2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
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
                <button class="btn btn-primary py-md-2 px-md-5 me-3 mt-md-3" onclick="findHistData()">Submit</button>
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
      </div>
    </div>
    <!-- /.box-body -->
  <?php
  } else {
  ?>
    <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="display: none;">
      <div class="container">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
          <h1 class="mb-0">Historical Data</h1>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Select Pair</label>
                <select id="pairSel" class="form-control px-4 select2" style="width: 100%;">
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
                <div id="reportrange" class="form-control px-4 select2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="fa fa-calendar"></i>&nbsp;
                  <span></span> <i class="fa fa-caret-down"></i>
                  <input id="startTimestamp" style="display: none;" />
                  <input id="endTimestamp" style="display: none;" />
                </div>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->

            <div class="col-md-4">
              <div class="form-group">
                <button class="btn btn-primary py-md-2 px-md-5 me-3 mt-md-3" onclick="findHistData()">Submit Query</button>
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
      </div>
    </div>
    <!-- /.box-body -->
  <?php
  }
  ?>

  <!-- Historical data end  -->

  <!-- Our Achievement section-->
  <div class="container-fluid bg-2 pt-4 mt-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-0">Our Achievements</h1>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
          <div class="service-item service-item1 rounded d-flex flex-column align-items-center justify-content-center text-center mt-150">
            <div class="service-icon">
              <img src="img/l1.png" class="feat">
            </div>
            <h5 class="m-0">USD 100 Million+ Remitted abroad hassle-free</h5>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
          <div class="service-item service-item2 rounded d-flex flex-column align-items-center justify-content-center text-center mt-75">
            <div class="service-icon">
              <img src="img/l2.png" class="feat">
            </div>
            <h5 class="m-0">Saved millions of rupees as exchange margin</h5>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
          <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center mt-25">
            <div class="service-icon">
              <img src="img/l3.png" class="feat">
            </div>
            <h5 class="m-0">100+ Satisfied <br>Corporates</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Blog Section start here -->
  <div class="container-fluid pt-4 blogssec wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 700px;">
        <h1 class="mb-0">Keep Yourself Updated with Our Blogs</h1>
      </div>
      <div class="owl-carousel blog-carousel wow fadeInUp mb-5" data-wow-delay="0.6s">

        <?php
        $conn = OpenCon();
        $sql = "SELECT * FROM blogs where published = 1 ORDER BY id DESC LIMIT 9 ";
        $posts = mysqli_query($conn, $sql);
        //$posts = get_posts('numberposts=10&order=ASC&orderby=post_title');
        while ($row = $posts->fetch_assoc()) { ?>

          <div class="blog-item bg-light rounded overflow-hidden">
            <div class="blog-img position-relative overflow-hidden">
              <?php if ($row['image_path']) { ?>
                <a href="blogs/single.php?post_slug=<?php echo $row['slug'] ?>" title="<?php $row['title']; ?>">
                  <img class="img-fluid" src="<?php echo 'https://ibrlive.com/' . $row['image_path']; ?>" class="img-responsive">
                </a>
              <?php } else { ?>
                <a href="blogs/single.php?post_slug=<?php echo $row['slug'] ?>" title="<?php $row['title']; ?>">
                  <img class="img-fluid" src="<?php echo 'https://ibrlive.com/pix.jpg' ?>" class="img-responsive">
                </a>
              <?php } ?>
            </div>
            <div class="p-4">
              <h5 class="mb-3"><?php echo substr_replace($row['title'], "...", 50); ?></h5>
              <div class="d-flex mb-3">
                <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo date('jS M Y', strtotime($row['date'])); ?></small>
              </div>
              <a class="text-uppercase" href="https://ibrlive.com/blogs/single.php?post_slug=<?php echo $row['slug'] ?>" title="Permanent Link to <?php echo $row['slug']; ?>">Continue Reading <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        <?php
        };
        ?>
        <!-- <div class="blog-item bg-light rounded overflow-hidden">
            <div class="blog-img position-relative overflow-hidden">
              <img class="img-fluid" src="img/blog-3.jpg" alt="">
            </div>
            <div class="p-4">
              <h5 class="mb-3">How to build a website</h5>
              <div class="d-flex mb-3">
                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
              </div>
              <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
              <a class="text-uppercase" href="">Continue Reading <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="blog-item bg-light rounded overflow-hidden">
            <div class="blog-img position-relative overflow-hidden">
              <img class="img-fluid" src="img/blog-3.jpg" alt="">
            </div>
            <div class="p-4">
              <h5 class="mb-3">How to build a website</h5>
              <div class="d-flex mb-3">
                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
              </div>
              <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
              <a class="text-uppercase" href="">Continue Reading <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="blog-item bg-light rounded overflow-hidden">
            <div class="blog-img position-relative overflow-hidden">
              <img class="img-fluid" src="img/blog-3.jpg" alt="">
            </div>
            <div class="p-4">
              <h5 class="mb-3">How to build a website</h5>
              <div class="d-flex mb-3">
                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
              </div>
              <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
              <a class="text-uppercase" href="">Continue Reading <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="blog-item bg-light rounded overflow-hidden">
            <div class="blog-img position-relative overflow-hidden">
              <img class="img-fluid" src="img/blog-3.jpg" alt="">
            </div>
            <div class="p-4">
              <h5 class="mb-3">How to build a website</h5>
              <div class="d-flex mb-3">
                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
              </div>
              <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
              <a class="text-uppercase" href="">Continue Reading <i class="bi bi-arrow-right"></i></a>
            </div>
          </div> -->
      </div>
      <div class="row g-5">
        <div class="col-lg-12 text-center">
          <a href="https://ibrlive.com/blogs" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Click To Read More Blogs <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Blog section end here-->

  <div class="container-fluid bg-3 pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-0">Certifications</h1>
      </div>
      <div class="row g-0">
        <div class="col-lg-5 wow slideInUp" data-wow-delay="0.6s">
          <div class="bg-light rounded bx">
            <div class="text-center py-0 px-5 mb-4">
              <img src="img/l4.jpg" alt="" class="dpit mb-3">
              <h4 class="mb-1 text-center">Recognized as a startup by DPIIT</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-2 wow slideInUp" data-wow-delay="0.3s">

        </div>
        <div class="col-lg-5 wow slideInUp" data-wow-delay="0.9s">
          <div class="rounded">
            <div class="text-center px-5 mb-0">
              <h4 class="mb-1 appl bx">Applied for License as full fledged money changer (FFMC) by RBI</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s" style="box-shadow: 0px 3px 3px #ada9a9;">
    <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-0">Why IBRLive?</h1>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
          <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center">
            <div class="service-icon">
              <img src="img/l5.png" class="feat">
            </div>
            <h5 class="m-2">No Delay Rates</h5>
            <p class="f-18">Real Time Exchange rates changing in seconds</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
          <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center">
            <div class="service-icon">
              <img src="img/l6.png" class="feat">
            </div>
            <h5 class="m-2">Unmatched Support</h5>
            <p class="f-18">Virtual assistance. Talk to us about any concerns, 24/7.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
          <div class="service-item rounded d-flex flex-column align-items-center justify-content-center text-center">
            <div class="service-icon">
              <img src="img/l7.png" class="feat">
            </div>
            <h5 class="m-2">Beginner-Friendly</h5>
            <p class="f-18">Easy peasy UI. Our interface is simple and easy to use.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container pt-5">
      <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h1 class="mb-0">What Our Clients Say</h1>
      </div>
      <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
        <div class="testimonial-item bg-light my-4">
          <div class="row">
            <div class="col-md-2">
              <div class="pt-4 pb-4 px-3">
                <img class="img-fluid rounded imgtestimonials" src="images/sheen-tex.png" style="width: 100%;">
              </div>
            </div>
            <div class="col-md-10">
              <div class="pt-4 pb-5 px-5">
                <p style="font-size: 16px;">It is a great experience while using your portal and your services since last Month (April 2022)</p>
                <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> The rates shown on the screen almost matches with the banker screen and it had helped us to cover the exchange rate difference that we were paying to banks from last so many year. Wish you all the best for your best services. </p>
                <h6 class="text-primary mb-1">Kiran Miglani (Sheen Tex India)</h6>
                <small class="text-lowercase"><a href="http://sheentexindia.com" target="_blank">http://sheentexindia.com</a></small>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item bg-light my-4">
          <div class="row">
            <div class="col-md-2">
              <div class="pt-4 pb-4 px-3">
                <img class="img-fluid rounded imgtestimonials" src="images/vi.png" style="width: 100%;">
              </div>
            </div>
            <div class="col-md-10">
              <div class="pt-4 pb-5 px-5">
                <p style="font-size: 16px;">It is a great experience doing transaction with the help of <a href="https://ibrlive.com">IBRLive.com</a>.</p>
                <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> In just one small transaction, I could manage to save money equivalent to 6 years of your website subscription fees. <br /> Thanks a lot for all the help and support during my first transaction and in negotiating with my bank</p>
                <h6 class="text-primary mb-1">Animesh Kumar, Virtue International</h6>
                <small class="text-lowercase"><a href="http://www.virtueinternational.co.in" target="_blank">http://www.virtueinternational.co.in</a></small>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item bg-light my-4">
          <div class="row">
            <div class="col-md-2">
              <div class="pt-4 pb-4 px-3">
                <img class="img-fluid rounded imgtestimonials" src="images/Javi-home-logo.png" style="width: 100%;">
              </div>
            </div>
            <div class="col-md-10">
              <div class="pt-4 pb-5 px-5">
                <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> We are using the facility since almost last one year. The rates quoted are genuine and matches with the rates offered by various banks. Due to the support we are able to hedge our forex exposures.</p>
                <h6 class="text-primary mb-1">Sahil Sharma, Javi Home Pvt. Ltd. </h6>
                <small class="text-lowercase"><a href="https://www.javihome.com" target="_blank">https://www.javihome.com</a></small>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item bg-light my-4">
          <div class="row">
            <div class="col-md-2">
              <div class="pt-4 pb-4 px-3">
                <img class="img-fluid rounded imgtestimonials" src="images/weavetex-logo.jpg" style="width: 100%;">
              </div>
            </div>
            <div class="col-md-10">
              <div class="pt-4 pb-5 px-5">
                <p class="text-info lead adjust2">It's a big advantage for the exporters.</p>
                <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> I have been using the portal for almost 2 months (since November 2021) now. The rates shown on the screen matches exact with the banker screen and it had helped me so much to cover the exchange rate difference that I've been paying to banks from last so many years.</p>
                <h6 class="text-primary mb-1">Abhishek Gupta, Weavetex Exports</h6>
                <small class="text-lowercase"><a href="https://www.linkedin.com/company/weavetex-exports/about/" target="_blank">https://www.linkedin.com/company/weavetex-exports/about/</a></small>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item bg-light my-4">
          <div class="row">
            <div class="col-md-2">
              <div class="pt-4 pb-4 px-3">
                <img class="img-fluid rounded imgtestimonials" src="images/adarsh.png" style="width: 100%;">
              </div>
            </div>
            <div class="col-md-10">
              <div class="pt-4 pb-5 px-5">
                <p class="text-info lead adjust2">Advantage of export rates to exporters</p>
                <p style="font-size: 16px;"><span class="glyphicon glyphicon-thumbs-up"></span> Since a long time we were getting lower exchange rates from the bank but now we have started to use IBRLive Screen for last three months (Since Nov 2021). It has helped us a lot to book the forward contract and credit the exporter bill payments at best exchange rates and to negotiate with the bank for the better exchange rate to show the IBRLive screen. As a result we are getting a big advantage of exchange rate difference.</p>
                <h6 class="text-primary mb-1">Mayank Singhal, Adarsh Fabs</h6>
                <small class="text-lowercase"><a href="https://www.indiamart.com/adarsh-fabs/aboutus.html" target="_blank">https://www.indiamart.com/adarsh-fabs/aboutus.html</a></small>
              </div>
            </div>
          </div>
        </div>
      </div>
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
