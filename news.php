<!DOCTYPE html>
<?php
  //header("Location: home.php"); 
  //exit();
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>News | IBR Live</title>
  <meta name="description" content="Get the latest financial news, India & International Business News.">
  <meta name="keywords" content="financial news, India & International Business News">


  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <script type="text/javascript">
    var urlNews = 'https://newsapi.org/v2/top-headlines?country=in&pageSize=15&category=business&apiKey=ae6228a1b731425fb97446ca3424d2bf';

    var req = new Request(urlNews);
      
    fetch(req).then(function(response) {
      return response.json();
    }).then(function(parsedJson) {
      //console.log(parsedJson.articles[0]);
      var pubDate;
      var newStr;
      
      var j=1;
      for(var i=0; i<10; i++){
      document.getElementById("newsFeed"+j).innerHTML = parsedJson.articles[i].title;
      document.getElementById("newsFeed"+j+"img").src = parsedJson.articles[i].urlToImage;
      document.getElementById("newsFeed"+j+"img").className = "img-thumbnail";
      
      document.getElementById("newsFeed"+j+"content").innerHTML = parsedJson.articles[i].content;
      document.getElementById("newsFeed"+j+"url").innerHTML = "Read complete article here ...";
      document.getElementById("newsFeed"+j+"url").href = parsedJson.articles[i].url;
      
      j++;
      }
      
      
    });
  </script>    
      
  <style>



blockquote{
  font-family: 'Oswald', sans-serif;
  line-height: 1.2em;
  font-size: 1.8em;
  column-span: 2; -webkit-column-span:2;
  margin: 0px;
  padding: 0px;
  margin-left: 5px;
 
}
h1{
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  font-size: 2em;
  line-height: 1em;
  text-align: center;
  font-weight: 500;
  padding: 0px;
  margin: 0px;
  margin-bottom: 25px;
}

h2, h3, h4, h5, h6{ font-family: 'PT Sans Narrow', sans-serif;text-transform: capitalize; }

h2{
  font-size: 1.5em;
  line-height: 1em;
  margin-top: 10px;
  margin-bottom: 10px;
}
h3{
  font-size: 2.4em;
  margin: 0px;
  padding: 0px;
  line-height: 0.8em;
  padding-top: 20px;
}
.time{
  text-align: center;
  font-family: 'PT Sans Narrow', sans-serif;
  border-top: 3px solid #333;

  font-size: 1.6em;

  font-weight: 500;
  /*text-transform: uppercase;*/
}

@media only all and (min-width: 600px) {
      
  article{
    -moz-columns:3; /* How many columns? */
    -webkit-columns:3;
    columns:3;
    -webkit-column-gap: 40px;
    -moz-column-gap: 40px;
    column-gap: 40px;  
    line-height: 1.5em;
    font-size: 1em;
    -webkit-column-rule: 1px outset #444;
    -moz-column-rule: 1px outset #444;
    column-rule: 1px outset #444; 
    padding: 20px;
  }
  
  h1{
    font-size: 2em;
    column-span: all; 
    -webkit-column-span:all;
  }
    
  .time{
    column-span: all; 
    -webkit-column-span:all;
  }
  
  p{
    text-align: justify;
    text-justify: inter-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
    hyphenate-character: "\u2605"; 
    
  }
  
}


  </style>

</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">
  <?php include_once('include/top-menu.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: white;">
<link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700|PT+Serif+Caption|PT+Serif:400,700,400italic,700italic|Oswald:400,700' rel='stylesheet' type='text/css'>

<article>
  <h1>Latest Business News <time><?php 
  date_default_timezone_set("Asia/Calcutta");
  echo " &ndash; ".date('D, M j, Y') ?>
  </time></h1>
  <div class="time" style="font-size: 14px; text-align: left;"><i>
      *Disclaimer: This news-feed is from third party. The linked sites are not under our control and we are not responsible for the contents of any linked site or any link contained in a linked site, or any changes or updates to such sites. We are providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by us of the site.</i> <b>This news feed is powered by <a target="_blank" href="https://newsapi.org/"> NEWSAPI.ORG</a></b>
      <hr/></div>
  
  <section>
    <h2 style="margin-left: 10px;" id="newsFeed1" name="newsFeed1"></h2>
    <img id="newsFeed1img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed1content" name="newsFeed1content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed1url" name="newsFeed1url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed2" name="newsFeed2"></h2>
    <img id="newsFeed2img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed2content" name="newsFeed2content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed2url" name="newsFeed2url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed3" name="newsFeed3"></h2>
    <img id="newsFeed3img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed3content" name="newsFeed3content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed3url" name="newsFeed3url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed4" name="newsFeed4"></h2>
    <img id="newsFeed4img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed4content" name="newsFeed4content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed4url" name="newsFeed4url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed5" name="newsFeed5"></h2>
    <img id="newsFeed5img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed5content" name="newsFeed5content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed5url" name="newsFeed5url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed6" name="newsFeed6"></h2>
    <img id="newsFeed6img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed6content" name="newsFeed6content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed6url" name="newsFeed6url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    
    <h2 style="margin-left: 10px;" id="newsFeed7" name="newsFeed7"></h2>
    <img id="newsFeed7img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed7content" name="newsFeed7content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed7url" name="newsFeed7url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed8" name="newsFeed8"></h2>
    <img id="newsFeed8img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed8content" name="newsFeed8content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed8url" name="newsFeed8url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed9" name="newsFeed9"></h2>
    <img id="newsFeed9img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed9content" name="newsFeed9content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed9url" name="newsFeed9url"></a>
    <hr style="border-top: 1px solid black;"/>
    
    <!-- -----------------------------------------  -->
    <h2 style="margin-left: 10px;" id="newsFeed10" name="newsFeed10"></h2>
    <img id="newsFeed10img" onerror="this.onerror=null;"/>
    <p style="margin-left: 10px;" id="newsFeed10content" name="newsFeed10content"></p>
    <a style="margin-left: 10px;" target="blank" id="newsFeed10url" name="newsFeed10url"></a>
    <hr style="border-top: 1px solid black;"/>
  </section>
  
</article>
    
                
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
<script src="dist/js/demo.js"></script>
</body>
</html>
