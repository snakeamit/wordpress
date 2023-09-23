<?php
if (session_id() == '' || !isset($_SESSION)) {
  session_start();
}
$allow = $_SESSION['userallow'];
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Terms and Conditions | IBR Live</title>

  <?php include_once('include/head.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
        <h4 class="display-3 text-white mb-md-4 animated zoomIn">Terms and Conditions </h4>
      </div>
    </div>
  </div>

  <div class="container-fluid stat-bg pt-4 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
      <p>
      <p>The terms "We" / "Us" / "Our"/”Firm” individually and collectively refer to <b>IBRLive India Private Limited</b> and the terms "Visitor” ”User” refer to <b>the users</b>.</p>

      <p>This page states the Terms and Conditions under which you (Visitor) may visit this website (“www.ibrlive.com”). Please read this page carefully. If you do not accept the Terms and Conditions stated here, we would request you to exit this site. The business, any of its business divisions and / or its subsidiaries, associate companies or subsidiaries to subsidiaries or such other investment companies (in India or abroad) reserve their respective rights to revise these Terms and Conditions at any time by updating this posting. You should visit this page periodically to re-appraise yourself of the Terms and Conditions, because they are binding on all users of this Website.</p>

      <p><b>USE OF CONTENT</b></p>

      <p>All logos, brands, marks headings, labels, names, signatures, numerals, shapes or any combinations thereof, appearing in this site, except as otherwise noted, are properties either owned, or used under licence, by the business and / or its associate entities who feature on this Website. The use of these properties or any other content on this site, except as provided in these terms and conditions or in the site content, is strictly prohibited.</p>

      <p>You may not sell or modify the content of this Website or reproduce, display, publicly perform, distribute, or otherwise use the materials in any way for any public or commercial purpose without the respective organisation’s or entity’s written permission.</p>

      <p><b>ACCEPTABLE WEBSITE USE</b></p>

      <p><b>(A) Security Rules</b>
      <p>
      <p>Visitors are prohibited from violating or attempting to violate the security of the Web site, including, without limitation, (1) accessing data not intended for such user or logging into a server or account which the user is not authorised to access, (2) attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorisation, (3) attempting to interfere with service to any user, host or network, including, without limitation, via means of submitting a virus or "Trojan horse" to the Website, overloading, "flooding", "mail bombing" or "crashing", or (4) sending unsolicited electronic mail, including promotions and/or advertising of products or services. Violations of system or network security may result in civil or criminal liability. The business and / or its associate entities will have the right to investigate occurrences that they suspect as involving such violations and will have the right to involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations.</p>

      <p><b>(B) General Rules</b></p>
      <p>Visitors may not use the Web Site in order to transmit, distribute, store or destroy material (a) that could constitute or encourage conduct that would be considered a criminal offence or violate any applicable law or regulation, (b) in a manner that will infringe the copyright, trademark, trade secret or other intellectual property rights of others or violate the privacy or publicity of other personal rights of others, or (c) that is libellous, defamatory, pornographic, profane, obscene, threatening, abusive or hateful.</p>

      <p><b>INDEMNITY</b></p>

      <p>The User unilaterally agree to indemnify and hold harmless, without objection, the Firm, its officers, directors, employees and agents from and against any claims, actions and/or demands and/or liabilities and/or losses and/or damages whatsoever arising from or resulting from their use of www.ibrlive.com or their breach of the terms.</p>

      <p><b>LIABILITY</b></p>

      <p>User agrees that neither Firm nor its group companies/Firms, directors, officers or employee shall be liable for any direct or/and indirect or/and incidental or/and special or/and consequential or/and exemplary damages, resulting from the use or/and the inability to use the service or/and for cost of procurement of substitute goods or/and services or resulting from any goods or/and data or/and information or/and services purchased or/and obtained or/and messages received or/and transactions entered into through or/and from the service or/and resulting from unauthorized access to or/and alteration of user's transmissions or/and data or/and arising from any other matter relating to the service, including but not limited to, damages for loss of profits or/and use or/and data or other intangible, even if Firm has been advised of the possibility of such damages.</p>

      <p>User further agrees that Firm shall not be liable for any damages arising from interruption, suspension or termination of service, including but not limited to direct or/and indirect or/and incidental or/and special consequential or/and exemplary damages, whether such interruption or/and suspension or/and termination was justified or not, negligent or intentional, inadvertent or advertent.
        User agrees that Firm shall not be responsible or liable to user, or anyone, for the statements or conduct of any third party of the service. In sum, in no event shall Firm’s total liability to the User for all damages or/and losses or/and causes of action exceed the amount paid by the User to Firm, if any, that is related to the cause of action.</p>

      <p><b>DISCLAIMER OF CONSEQUENTIAL DAMAGES</b></p>

      <p>In no event shall Firm or any parties, organizations or entities associated with the corporate brand name us or otherwise, mentioned at this Website be liable for any damages whatsoever (including, without limitations, incidental and consequential damages, lost profits, or damage to computer hardware or loss of data information or business interruption) resulting from the use or inability to use the Website and the Website material, whether based on warranty, contract, tort, or any other legal theory, and whether or not, such organization or entities were advised of the possibility of such damages.</p>
      </p>
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