<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['userallow']))
  $allow = $_SESSION['userallow'];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RBI Directions | IBR Live</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <meta name="keywords" content="rbi guidelines for foreign exchange transactions,master direction on ecb,rbi fdi master direction,rbi master direction on export of goods and services,rbi master direction on import of goods and services,Export Master Direction,rbi guidelines foreign exchange,fema regulations rbi,fema guidelines for inward and outward remittance">
  <meta name="description" content="Latest RBI guidelines for foreign exchange transactions. RBI Master Directions on Import, Exports, ECB, FDI, ODI & more. Read now!">
  <?php include_once('include/head.php'); ?>
  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script>
    function showDir(val) {
      var nid = "dir-" + val;
      document.getElementById(nid).style.display = "block";
      document.getElementById(nid).style.textAlign = "center";

      var i;
      for (i = 1; i <= 18; i++) {
        dhide = "dir-" + i;
        if (i != val) {
          document.getElementById(dhide).style.display = "none";
        }
      }
    }
  </script>

  <style>
    hr.divider {
      max-width: 3.25rem;
      border-width: 0.2rem;
      border-color: #f4623a;
    }
  </style>
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body>


  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center d-none">
    <div class="spinner"></div>
  </div>
  <div class="container-fluid position-relative p-0 head-nav">
    <?php include_once('include/top-menu.php'); ?>

    <div id="header-carousel" class="slide-header">
      <div class="p-3" style="max-width: 900px; margin: 0 auto;">
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Latest RBI Master Directions on Foreign Exchange Management </h4>
      </div>
    </div>
  </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="">

              <div class="box-body">
                <!-- text input -->

                <table id="example2" class="" border=1 align=center style="font-size: 16px;">
                  <thead>
                    <tr style="background: #566573; color: white;">
                      <th style="text-align: center;">Sr. No.</th>
                      <th style="text-align: center;">Description</th>
                    </tr>
                  </thead>

                  <tbody style="line-height:30px; text-align: center;">
                    <tr>
                      <td>1</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(1)" style="color: #000080;">&nbsp; Acquisition and Transfer of Immovable Property under Foreign Exchange Management Act, 1999 (Updated as on April 11, 2018)</a>

                        <embed style="display:none;" id="dir-1" src="rbi-directions-dir/foreign-exchange/Master Direction – Acquisition and Transfer of Immovable  Property under Foreign Exchange Management Act, 1999 (Updat ed as on April 11, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>2</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(2)" style="color: #000080;">&nbsp; Borrowing and Lending transactions in Indian Rupee between Persons Resident in India and Non-Resident Indians, Persons of Indian Origin</a>
                        <br />
                        <embed style="display:none;" id="dir-2" src="rbi-directions-dir/foreign-exchange/Master Direction – Borrowing and Lending transactions in  Indian Rupee between Persons Resident in India and Non-Resi dent Indians, Persons of Indian Origin.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>3</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(3)" style="color: #000080;">&nbsp; Deposits and Accounts (Updated as on June 23, 2016)</a>
                        <br />
                        <embed style="display:none;" id="dir-3" src="rbi-directions-dir/foreign-exchange/Master Direction - Deposits and Accounts (Updated as on June 23, 2016).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>4</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(4)" style="color: #000080;">&nbsp; Direct Investment by Residents in Joint Venture (JV) Wholly Owned Subsidiary (WOS) Abroad update d 4th Jan 2018</a>
                        <br />
                        <embed style="display:none;" id="dir-4" src="rbi-directions-dir/foreign-exchange/Master Direction – Direct Investment by Residents in Joi nt Venture (JV)  Wholly Owned Subsidiary (WOS) Abroad update d 4th Jan 2018.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>5</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(5)" style="color: #000080;">&nbsp; Establishment of Branch Office (BO),Liaison Office (LO),Project Office (PO) or any other place of business in India by foreign entities</a>
                        <br />
                        <embed style="display:none;" id="dir-5" src="rbi-directions-dir/foreign-exchange/Master Direction - Establishment of Branch Office (BO),Liaison Office (LO),Project Office (PO) or any other place of business in India by foreign entities.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>6</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(6)" style="color: #000080;">&nbsp; Export of Goods and Services updated 12 Jan 2018</a>
                        <br />
                        <embed style="display:none;" id="dir-6" src="rbi-directions-dir/foreign-exchange/Master Direction – Export of Goods and Services updated  12 Jan 2018.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>7</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(7)" style="color: #000080;">&nbsp; External Commercial Borrowings, Trade Credit, Borrowing and lending in foreign currency by authorised dealers and persons other then authorised dealers updated 22 Nov 2018</a>
                        <br />
                        <embed style="display:none;" id="dir-7" src="rbi-directions-dir/foreign-exchange/Master Direction - External Commercial Borrowings, Trade Credit, Borrowing and lending in foreign currency by aurhorised dealers and persons other then authorised dealers updated 22 Nov 2018.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>8</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(8)" style="color: #000080;">&nbsp; Foreign Investment in India updated 4th January 2018</a>
                        <br />
                        <embed style="display:none;" id="dir-8" src="rbi-directions-dir/foreign-exchange/Master Direction – Foreign Investment in India updated 4 th January 2018.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>9</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(9)" style="color: #000080;">&nbsp; Import of Goods and Services (Updated as on February 02, 2018)</a>
                        <br />
                        <embed style="display:none;" id="dir-9" src="rbi-directions-dir/foreign-exchange/Master Direction – Import of Goods and Services (Updated  as on February 02, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>10</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(10)" style="color: #000080;">&nbsp; Liberalised Remittance Scheme (LRS) (Updated as on June 20, 2018)</a>
                        <br />
                        <embed style="display:none;" id="dir-10" src="rbi-directions-dir/foreign-exchange/Master Direction - Liberalised Remittance Scheme (LRS) (Updated as on June 20, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>11</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(11)" style="color: #000080;">&nbsp; Miscellaneous (Updated as on November 12, 2018)</a>
                        <br />
                        <embed style="display:none;" id="dir-11" src="rbi-directions-dir/foreign-exchange/Master Direction - Miscellaneous (Updated as on November 12, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>12</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(12)" style="color: #000080;">&nbsp; Money Changing Activities updated 8 Dec 2017</a>
                        <br />
                        <embed style="display:none;" id="dir-12" src="rbi-directions-dir/foreign-exchange/Master Direction - Money Changing Activities updated 8 Dec 2017.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>13</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(13)" style="color: #000080;">&nbsp; Money Transfer Service Scheme MTSS updated 22nd Feb 2017</a>
                        <br />
                        <embed style="display:none;" id="dir-13" src="rbi-directions-dir/foreign-exchange/Master Direction – Money Transfer Service Scheme MTSS up dated 22nd Feb 2017.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>14</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(14)" style="color: #000080;">&nbsp; Opening and Maintenance of Rupee, Foreign Currency Vostro Accounts of Non-resident Exchange Houses updated 31.08.2018</a>
                        <br />
                        <embed style="display:none;" id="dir-14" src="rbi-directions-dir/foreign-exchange/Master Direction – Opening and Maintenance of Rupee,Fore ign Currency Vostro Accounts of Non-resident Exchange Houses  updated 31.08.2018.PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>15</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(15)" style="color: #000080;">&nbsp; Other Remittance Facilities (Updated as on November 6, 2018)</a>
                        <br />
                        <embed style="display:none;" id="dir-15" src="rbi-directions-dir/foreign-exchange/Master Direction - Other Remittance Facilities (Updated as on November 6, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>16</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(16)" style="color: #000080;">&nbsp; Remittance of Assets (Updated as on April 28, 2016)</a>
                        <br />
                        <embed style="display:none;" id="dir-16" src="rbi-directions-dir/foreign-exchange/Master Direction - Remittance of Assets (Updated as on April 28, 2016).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>17</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(17)" style="color: #000080;">&nbsp; Reporting under Foreign Exchange Management Act, 1999 (Updated as on November 20, 2018)</a>
                        <br />
                        <embed style="display:none;" id="dir-17" src="rbi-directions-dir/foreign-exchange/Master Direction – Reporting under Foreign Exchange Mana gement Act, 1999 (Updated as on November 20, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                    <tr>
                      <td>18</td>
                      <td style="text-align: left;"><a href="#" onclick="showDir(18)" style="color: #000080;">&nbsp; Compounding of Contraventions under FEMA, 1999 (Updated as on September 19, 2018)</a>
                        <br />
                        <embed style="display:none;" id="dir-18" src="rbi-directions-dir/foreign-exchange/Master Direction- Compounding of Contraventions under FEMA, 1999 (Updated as on September 19, 2018).PDF" width="100%" height="375">
                      </td>
                    </tr>

                  </tbody>

                </table>
              </div>
            </div><!-- /.box -->
          </div>
        </div><!-- ./row -->
      </section>
    </div>
  </div>


  <?php include_once("include/footer.php"); ?>
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
  <script src="dist/js/demo.js"></script>
</body>

</html>